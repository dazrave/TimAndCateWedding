# 🎉 RSVP Form Logic Overview – Tim & Cate’s Wedding

This file outlines the full logic for the dynamic RSVP form and how it behaves for different types of guests and answers. It serves as a reference for testing, debugging, and future development.

---

## 🧠 Group Definitions

Guests are split into three groups, defined by the `Group_ID` field:

- **Group 1** – Fully Hosted  
  Guests are offered free onsite accommodation and Friday dinner.

- **Group 2** – Subsidised  
  Guests are offered accommodation for £100 per night (£200 total) and invited to Friday dinner.

- **Group 3** – Non-Accommodation Guests  
  These guests are not offered accommodation or Friday dinner. They see a simpler RSVP.

---

## 📥 Step-by-Step Form Logic

### 1. **Attendance Selection (Always Shown)**
- Field: `Attendance_Group` (required)
- Options depend on group size:
  - Solo guest: `attending`, `not_attending`
  - Group invite: `all_attending`, `some_attending`, `not_attending`

---

### 2. **Individual Attendance (If "Some Attending")**
- Field: `Individual_Attendance[]` (checkbox list)
- Required: Yes, at least **one** checkbox must be selected
- Shown: Only if `Attendance_Group` = `some_attending`

---

### 3. **Dietary Requirements**
- Field: `Dietary_Requirements` (required if attending)
- Required: If any attendance selected other than `not_attending`
- Prompted with: “If none, please write 'None'”
- Shown: If `Attendance_Group` is one of: `attending`, `all_attending`, `some_attending`

---

### 4. **Accommodation Questions (Group 1 or 2 only, and only if attending)**

#### 4a. Staying Onsite
- Field: `Staying_Onsite` (required if shown)
- Shown: If `Group_ID` is 1 or 2 AND attending
- Required: Yes

#### 4b. Friday Dinner
- Field: `Friday_Dinner` (required if shown)
- Shown: Only if `Staying_Onsite` = `yes`
- Required: Yes

---

### 5. **Message to the Couple**
- Field: `Final_Notes`
- Shown: Always
- Required: No
- Placeholder: “Leave us a note, a message, or something funny…”

---

## 🚫 What is Hidden for "Not Attending"

If a guest selects **`not_attending`**, the following fields are hidden and not required:
- Individual attendance
- Dietary requirements
- Accommodation (stay/dinner)
- Only the notes box remains visible.

---

## 💾 Server-Side Validation Summary

- Rejects if:
  - `Attendance_Group` is empty
  - `some_attending` selected but no individual checkboxes are ticked
  - Attending but dietary field is empty
  - Staying onsite (`yes`) selected but Friday dinner not answered
- Only validates fields if they were **shown in the form**

---

## 🧪 Test Cases

You can test the logic using the following scenarios:

### ➕ Scenario 1: Group 1 – All Attending
- ✅ Dietary required
- ✅ Stay and dinner required

### ➕ Scenario 2: Group 2 – Some Attending
- ✅ Select individual attendees
- ✅ Dietary required
- ✅ Stay/dinner questions required if staying onsite

### ➕ Scenario 3: Group 3 – Not Attending
- ✅ No required fields except attendance
- ✅ Notes field still shown

### ➕ Scenario 4: Solo guest – Attending
- ✅ Dietary required
- ✅ Stay/dinner if Group 1 or 2

---

## 📝 Notes

- `Group_ID` is passed in session from the invite lookup
- All conditional fields are managed both via **JavaScript** (for UI) and **server-side validation** (for robustness)

---