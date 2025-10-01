<?php
session_start();

// ✅ Make sure invite is loaded first so $invite exists
if (!isset($_SESSION['invite'])) {
    header('Location: index.php');
    exit;
}

$invite = $_SESSION['invite']; // ✅ now $invite exists here

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['rsvp_attendance'] = $_POST['Attendance_Group'] ?? '';
    $_SESSION['group_id'] = $invite['Group_ID']; // ✅ now correctly set
    header('Location: thankyou.php');
    exit;
}

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>RSVP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      @keyframes fadeInUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
      }
      .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out forwards;
      }
    </style>
</head>
<body class="bg-gray-100">

<!-- RSVP Section -->
<section class="relative flex justify-center items-center min-h-screen bg-[url('/images/autumn_wedding.webp')] bg-cover bg-center">
  <!-- Dark overlay -->
  <div class="absolute inset-0 bg-black/40"></div>

  <!-- ✅ RSVP Card (centered, frosted glass, animated) -->
  <div class="relative bg-white/90 backdrop-blur-lg shadow-xl rounded-xl w-full max-w-3xl mx-auto p-4 sm:p-6 md:p-8
              transform transition-all duration-500 ease-out hover:scale-[1.01] animate-fadeInUp">

    <h2 class="text-2xl sm:text-3xl font-bold text-center mb-2">
      RSVP for <?= htmlspecialchars($invite['User_Present_Name'] ?? 'our wedding') ?>
    </h2>
    <p class="text-base sm:text-lg text-center italic text-gray-600 mb-1">
      Please RSVP by 31st December 2025
    </p>
    <p class="text-sm sm:text-base text-center text-gray-600 mb-6">
      If we don’t hear from you, we’ll assume you can’t join us
    </p>

    <!-- RSVP Form -->
    <form method="POST" id="rsvp-form" action="submit_rsvp.php" class="space-y-6 text-base sm:text-lg">

      <!-- Step 1: Attendance -->
      <div>
        <label class="block font-medium mb-1">Can you attend the wedding? <span class="text-red-500">*</span></label>
        <select name="Attendance_Group" id="Attendance_Group" required
          class="w-full rounded-md border border-gray-300 px-5 py-3 text-lg
                 focus:outline-none focus:ring-2 focus:ring-red-500 
                 focus:scale-[1.01] transition-transform duration-300">
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

      <!-- Step 2: Individual Attendance -->
      <div id="individual-attendance" class="hidden">
        <label class="block font-medium mb-1">Who can attend? <span class="text-red-500">*</span></label>
        <?php foreach ($user_ids as $index => $id): ?>
          <div class="mb-2">
            <label class="inline-flex items-center">
              <input type="checkbox" name="Individual_Attendance[]" value="<?= $id ?>" class="mr-2">
              <?= htmlspecialchars($user_names[$index]) ?>
            </label>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Step 3: Dietary Requirements -->
      <div id="dietary-container" class="hidden">
        <label for="Dietary_Requirements" class="block font-medium mb-1">Do you have any dietary requirements? <span class="text-red-500">*</span></label>
        <textarea name="Dietary_Requirements" id="Dietary_Requirements" rows="3"
          class="w-full rounded-md border border-gray-300 px-5 py-3 text-lg resize-none
                 focus:outline-none focus:ring-2 focus:ring-red-500 
                 focus:scale-[1.01] transition-transform duration-300"
          placeholder="If none, please write 'None'"></textarea>
        <p id="dietary-error" class="text-red-600 text-sm mt-1 hidden">Please provide dietary requirements or write 'None'.</p>
      </div>

      <!-- Step 4: Stay Questions (Group 1 & 2) -->
      <?php if ($group_id === 1 || $group_id === 2): ?>
        <div id="stay-container" class="hidden space-y-4">
          <p class="font-medium">
            <?= $is_solo ? "We’d love to invite you to stay with us for the weekend at the venue." : "We’d love to invite you all to stay with us for the weekend at the venue." ?>
            <?php if ($group_id === 1): ?>
                Free of charge.
            <?php else: ?>
                The cost is £100 per night (<?= $is_solo ? '£100' : '£200' ?> in total).
            <?php endif; ?>
            Due to check-in/out rules, <?= $is_solo ? "you’d need to arrive Friday and leave Sunday." : "you’d all need to arrive Friday and leave Sunday." ?> 
            Would you like to stay with us at the venue?
          </p>
          <select name="Staying_Onsite" id="Staying_Onsite"
            class="w-full rounded-md border border-gray-300 px-5 py-3 text-lg
                   focus:outline-none focus:ring-2 focus:ring-red-500 
                   focus:scale-[1.01] transition-transform duration-300">
            <option value="">Please select</option>
            <option value="yes">Yes please!</option>
            <option value="no">Thank you, but we'll make our own arrangements</option>
          </select>

          <div id="friday-dinner-container" class="hidden">
            <label class="block font-medium mt-4">You have the option to join us for dinner on Friday evening, but you have to be checked in by 6pm. Would you care to join us? <span class="text-red-500">*</span></label>
            <select name="Friday_Dinner" id="Friday_Dinner"
              class="w-full rounded-md border border-gray-300 px-5 py-3 text-lg
                     focus:outline-none focus:ring-2 focus:ring-red-500 
                     focus:scale-[1.01] transition-transform duration-300">
              <option value="">Please select</option>
              <option value="yes">Dinner sounds great, we'll be there before 6pm</option>
              <option value="no">No, we'll sort our own dinner, thanks</option>
            </select>
          </div>
        </div>
      <?php endif; ?>

      <!-- Step 5: Notes -->
      <div>
        <label for="Final_Notes" class="block font-medium mb-1">Message to the couple</label>
        <textarea name="Final_Notes" id="Final_Notes" rows="3"
          class="w-full rounded-md border border-gray-300 px-5 py-3 text-lg resize-none
                 focus:outline-none focus:ring-2 focus:ring-red-500 
                 focus:scale-[1.01] transition-transform duration-300"
          placeholder="Leave us a note, a message, or something funny…"></textarea>
      </div>

      <!-- Hidden Inputs -->
      <input type="hidden" name="Invite_ID" value="<?= htmlspecialchars($invite['Invite_ID']) ?>">
      <input type="hidden" name="Login_Code" value="<?= htmlspecialchars($invite['Login_Code']) ?>">

      <!-- Submit -->
      <div>
        <button type="submit"
          class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 text-lg rounded-full 
                 transform transition-all duration-300 hover:scale-[1.02]">
          Submit RSVP
        </button>
      </div>
    </form>
  </div>
</section>

<script>
    const attendanceSelect = document.getElementById('Attendance_Group');
    const individualDiv = document.getElementById('individual-attendance');
    const dietaryContainer = document.getElementById('dietary-container');
    const dietaryTextarea = document.getElementById('Dietary_Requirements');
    const dietaryError = document.getElementById('dietary-error');
    const stayContainer = document.getElementById('stay-container');
    const stayingSelect = document.getElementById('Staying_Onsite');
    const fridayDinnerContainer = document.getElementById('friday-dinner-container');
    const fridayDinnerSelect = document.getElementById('Friday_Dinner');
    const form = document.getElementById('rsvp-form');

    function updateFormVisibility() {
        const attendance = attendanceSelect?.value;

        individualDiv?.classList.add('hidden');
        dietaryContainer?.classList.add('hidden');
        stayContainer?.classList.add('hidden');
        fridayDinnerContainer?.classList.add('hidden');

        stayingSelect?.removeAttribute('required');
        fridayDinnerSelect?.removeAttribute('required');
        dietaryError?.classList.add('hidden');

        if (attendance === 'not_attending') return;

        if (attendance === 'some_attending') {
            individualDiv?.classList.remove('hidden');
            dietaryContainer?.classList.remove('hidden');
            if (stayContainer) {
                stayContainer.classList.remove('hidden');
                stayingSelect?.setAttribute('required', 'required');
            }
        }

        if (['attending', 'all_attending'].includes(attendance)) {
            dietaryContainer?.classList.remove('hidden');
            if (stayContainer) {
                stayContainer.classList.remove('hidden');
                stayingSelect?.setAttribute('required', 'required');
            }
        }
    }

    function updateDinnerVisibility() {
        if (!stayingSelect || !fridayDinnerContainer) return;
        const stayVal = stayingSelect.value;
        if (stayVal === 'yes') {
            fridayDinnerContainer.classList.remove('hidden');
            fridayDinnerSelect?.setAttribute('required', 'required');
        } else {
            fridayDinnerContainer.classList.add('hidden');
            fridayDinnerSelect?.removeAttribute('required');
            fridayDinnerSelect.value = '';
        }
    }

    form?.addEventListener('submit', function (e) {
        const attendance = attendanceSelect?.value;

        if (attendance === 'some_attending') {
            const checkboxes = document.querySelectorAll('input[name="Individual_Attendance[]"]');
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            if (!anyChecked) {
                alert('Please select at least one person who can attend.');
                e.preventDefault();
                return;
            }
        }

        const isAttending = ['attending', 'some_attending', 'all_attending'].includes(attendance);
        if (isAttending && dietaryTextarea && dietaryTextarea.value.trim() === '') {
            e.preventDefault();
            dietaryError?.classList.remove('hidden');
            dietaryTextarea.scrollIntoView({ behavior: 'smooth', block: 'center' });
            dietaryTextarea.focus();
        }
    });

    attendanceSelect?.addEventListener('change', updateFormVisibility);
    stayingSelect?.addEventListener('change', updateDinnerVisibility);

    updateFormVisibility();
    updateDinnerVisibility();
</script>
</body>
</html>