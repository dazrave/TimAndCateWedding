<?php
session_start();

if (!isset($_SESSION['invite'])) {
    header('Location: index.php');
    exit;
}

$invite = $_SESSION['invite'];
$user_ids = explode(',', $invite['User_ID']);
$user_names = explode(',', $invite['User_Name']);
$group_size = count($user_ids);
$group_id = isset($invite['Group_ID']) ? intval($invite['Group_ID']) : 3;
$is_solo = ($group_size === 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RSVP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <form method="POST" action="submit_rsvp.php" class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl space-y-6">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">RSVP for <?= htmlspecialchars($invite['User_Present_Name']) ?></h1>

        <!-- Step 1: Attendance (Group-Level) -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Can you attend the wedding? <span class="text-red-500">*</span></label>
            <select name="Attendance_Group" id="Attendance_Group" class="w-full p-2 border rounded" required>
                <option value="">Please select</option>
                <?php if ($group_size === 1): ?>
                    <option value="attending">I am able to attend</option>
                    <option value="not_attending">I am unable to attend</option>
                <?php else: ?>
                    <option value="all_attending">We can all attend</option>
                    <option value="some_attending">Some of us can attend</option>
                    <option value="not_attending">We are unable to attend</option>
                <?php endif; ?>
            </select>
        </div>

        <!-- Step 2: Individual Attendance if "some_attending" -->
        <div id="individual-attendance" class="hidden">
            <label class="block text-gray-700 font-semibold mb-2">Who can attend? <span class="text-red-500">*</span></label>
            <?php foreach ($user_ids as $index => $id): ?>
                <div class="mb-2">
                    <label>
                        <input type="checkbox" name="Individual_Attendance[]" value="<?= $id ?>" class="mr-2 required-if-shown">
                        <?= htmlspecialchars($user_names[$index]) ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Step 3: Dietary Requirements -->
        <div id="dietary-container" class="hidden">
            <label for="Dietary_Requirements" class="block text-gray-700 font-semibold mb-2">Do you have any dietary requirements? <span class="text-red-500">*</span></label>
            <textarea name="Dietary_Requirements" id="Dietary_Requirements" rows="3" class="w-full p-2 border rounded" placeholder="If none, please write 'None'" required></textarea>
        </div>

        <!-- Step 4: Group_ID Specific Questions (only if attending) -->
        <?php if ($group_id === 1 || $group_id === 2): ?>
        <div id="stay-container" class="hidden space-y-4">
            <label class="block text-gray-700 font-semibold">
                <?= $is_solo ? "We’d love to invite you to stay with us for the weekend at the venue." : "We’d love to invite you all to stay with us for the weekend at the venue." ?>
                <?php if ($group_id === 1): ?>
                    Free of charge.
                <?php else: ?>
                    The cost is £100 per night (<?= $is_solo ? '£100' : '£200' ?> in total).
                <?php endif; ?>
                Due to check-in/out rules, <?= $is_solo ? "you’d need to arrive Friday and leave Sunday." : "you’d all need to arrive Friday and leave Sunday." ?>
            </label>
            <select name="Staying_Onsite" id="Staying_Onsite" class="w-full p-2 border rounded" required>
                <option value="">Please select</option>
                <option value="yes"><?= $is_solo ? "I’d love to" : "We’d love to" ?></option>
                <option value="no"><?= $is_solo ? "I can’t stay for the weekend" : "We can’t stay for the weekend" ?></option>
            </select>

            <div id="friday-dinner-container" class="hidden">
                <label class="block text-gray-700 font-semibold mt-4">
                    <?= $is_solo
                        ? "We’re also running a buffet on the Friday evening — to join us, you’d need to check in by 6pm. Will you be joining us for dinner?"
                        : "We’re also running a buffet on the Friday evening — to join us, you’d all need to check in by 6pm. Will you be joining us for dinner?" ?>
                </label>
                <select name="Friday_Dinner" id="Friday_Dinner" class="w-full p-2 border rounded" required>
                    <option value="">Please select</option>
                    <option value="yes"><?= $is_solo ? "I’d love to join you and can check in by 6pm" : "We’d love to join you and can check in by 6pm" ?></option>
                    <option value="no"><?= $is_solo ? "I can’t join due to travel or other plans" : "We can’t join due to travel or other plans" ?></option>
                </select>
            </div>
        </div>
        <?php endif; ?>

        <!-- Step 5: Notes to Couple (Always Shown) -->
        <div>
            <label for="Final_Notes" class="block text-gray-700 font-semibold mb-2">Message to the couple</label>
            <textarea name="Final_Notes" id="Final_Notes" rows="3" class="w-full p-2 border rounded" placeholder="Leave us a note, a message, or something funny…"></textarea>
        </div>

        <input type="hidden" name="Invite_ID" value="<?= htmlspecialchars($invite['Invite_ID']) ?>">
        <input type="hidden" name="Login_Code" value="<?= htmlspecialchars($invite['Login_Code']) ?>">

        <button type="submit" class="w-full bg-red-600 text-white font-bold py-2 rounded hover:bg-red-700">Submit RSVP</button>
    </form>

    <script>
        const attendanceSelect = document.getElementById('Attendance_Group');
        const individualDiv = document.getElementById('individual-attendance');
        const dietaryContainer = document.getElementById('dietary-container');
        const stayContainer = document.getElementById('stay-container');
        const stayingSelect = document.getElementById('Staying_Onsite');
        const fridayDinnerContainer = document.getElementById('friday-dinner-container');
        const fridayDinnerSelect = document.getElementById('Friday_Dinner');

        function updateFormVisibility() {
            const attendance = attendanceSelect.value;

            individualDiv.classList.add('hidden');
            dietaryContainer.classList.add('hidden');
            if (stayContainer) stayContainer.classList.add('hidden');
            if (fridayDinnerContainer) fridayDinnerContainer.classList.add('hidden');

            if (attendance === 'some_attending') {
                individualDiv.classList.remove('hidden');
                dietaryContainer.classList.remove('hidden');
                if (stayContainer) stayContainer.classList.remove('hidden');
            } else if (attendance === 'all_attending' || attendance === 'attending') {
                dietaryContainer.classList.remove('hidden');
                if (stayContainer) stayContainer.classList.remove('hidden');
            }
        }

        function updateDinnerVisibility() {
            if (!stayingSelect || !fridayDinnerContainer) return;
            const stayVal = stayingSelect.value;
            if (stayVal === 'yes') {
                fridayDinnerContainer.classList.remove('hidden');
                fridayDinnerSelect.setAttribute('required', 'required');
            } else {
                fridayDinnerContainer.classList.add('hidden');
                fridayDinnerSelect.removeAttribute('required');
                fridayDinnerSelect.value = '';
            }
        }

        attendanceSelect.addEventListener('change', updateFormVisibility);
        if (stayingSelect) {
            stayingSelect.addEventListener('change', updateDinnerVisibility);
        }
    </script>
</body>
</html>
<?php

