# 🧪 Manual Test Script – RSVP Form (Tim & Cate’s Wedding)

This test script covers all user journeys using your created test accounts:

- `test1` – Fully funded solo guest (Group 1)
- `test2` – Subsidised solo guest (Group 2)
- `test3` – No-room solo guest (Group 3)
- `test4` + `test5` – Subsidised couple (Group 2)

For each scenario, follow the instructions and verify expected behaviour.

---

## ✅ SCENARIO 1: `test1` – Fully Funded Solo Guest (Group 1)

### A. Accepting (Attending)
1. Select: `I am able to attend`
2. Check: **Dietary Requirements** field appears and is required
3. Enter: `"None"`
4. Check: **Staying Onsite** question appears (required)
    - Select: `"I’d love to"`
5. Check: **Friday Dinner** question appears (required)
    - Select: `"I’d love to join you and can check in by 6pm"`
6. Leave a note (optional)
7. Submit
8. ✅ Confirm: Redirect to **Thank You page with “We can't wait to celebrate” message**

### B. Declining (Not Attending)
1. Select: `I am unable to attend`
2. Check: Only **notes** box is visible
3. Submit (leave notes blank or write something)
4. ✅ Confirm: Redirect to **Thank You page with “We’ll miss you dearly” message**

---

## ✅ SCENARIO 2: `test2` – Subsidised Solo Guest (Group 2)

### A. Accepting (Attending)
1. Select: `I am able to attend`
2. Check: **Dietary Requirements** field appears and is required
3. Enter: `"Vegetarian"`
4. Check: **Staying Onsite** appears (required)
    - Select: `"I’d love to"`
5. Check: **Friday Dinner** appears (required)
    - Select: `"I can’t join due to travel or other plans"`
6. Leave a message (optional)
7. Submit
8. ✅ Confirm: Redirect to Thank You page (celebratory message)

### B. Declining
1. Select: `I am unable to attend`
2. All optional fields hidden except notes
3. Submit
4. ✅ Confirm: Thank You page shows “We’ll miss you dearly”

---

## ✅ SCENARIO 3: `test3` – No Room Solo Guest (Group 3)

### A. Accepting
1. Select: `I am able to attend`
2. **Dietary Requirements** appears (required)
3. Enter: `"Low FODMAP"`
4. **No staying or dinner questions** shown
5. Submit
6. ✅ Confirm: Thank You page (celebratory)

### B. Declining
1. Select: `I am unable to attend`
2. Only notes visible
3. Submit
4. ✅ Confirm: Thank You page (“We’ll miss you dearly”)

---

## ✅ SCENARIO 4: `test4` + `test5` – Subsidised Couple (Group 2, Group Size > 1)

### A. Everyone Attending
1. Select: `We can all attend`
2. **Dietary** appears (required)
3. Enter: `"None"`
4. **Staying Onsite** appears (required)
    - Select: `"We’d love to"`
5. **Friday Dinner** appears (required)
    - Select: `"We’d love to join you and can check in by 6pm"`
6. Leave note (optional)
7. Submit
8. ✅ Confirm: Thank You page (celebratory)

### B. Some Attending
1. Select: `Some of us can attend`
2. **Individual checkboxes** appear
    - Select only one attendee (test4 or test5)
3. **Dietary** appears (required)
4. **Staying Onsite** appears (required)
    - Select: `"We can’t stay for the weekend"`
5. **Friday Dinner** should not appear
6. Submit
7. ✅ Confirm: Thank You page (celebratory)

### C. Declining
1. Select: `We are unable to attend`
2. All fields except notes hidden
3. Submit
4. ✅ Confirm: Thank You page (“We’ll miss you dearly”)

---

## 🧪 Edge Case Validations

### Required Fields Logic
- ✅ “Submit” should be blocked unless:
  - Attendance is selected
  - If `some_attending`, at least one checkbox selected
  - If attending, dietary must be filled
  - If staying onsite = yes, Friday Dinner must be answered

### Conditional Visibility
- ✅ Dietary + Stay + Dinner only appear if **appropriate**
- ✅ All hidden fields are **not validated server-side** if not shown
- ✅ "Notes to the couple" always remains optional

---

## 📦 Additional Test Ideas
- Try refreshing or submitting twice (shouldn’t duplicate)
- Use dev tools to hide required fields manually — test backend robustness
- Test on mobile vs desktop layout
- Use browser back button after submitting to check behaviour

---