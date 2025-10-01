---
title: tim-cate-wedding
emoji: 🐳
colorFrom: gray
colorTo: pink
sdk: static
pinned: false
tags:
  - deepsite
---

[ User Flow ]
   |
   v
index.php (Landing/Login Page)
   - User enters Login_Code
   - System checks Google Sheet for Invite
   |
   |---> If Login_Code not found → Show error
   |
   v
[ Invite Found ]
   |
   |---> If RSVP not submitted yet
   |         v
   |     rsvp.php (RSVP Form)
   |         - Shows household members (User_Present_Name)
   |         - Group logic:
   |              Group 1 → Staying onsite (fully funded)
   |              Group 2 → Option to stay onsite (£100/night)
   |              Group 3 → Day invite only (no accommodation)
   |         - Guest fills in:
   |              Attendance (yes/no)
   |              Individual attendance
   |              Dietary requirements
   |              Friday dinner
   |              Notes
   |         - Submit → submit_rsvp.php
   |                 |
   |                 v
   |         submit_rsvp.php
   |             - Updates Google Sheet:
   |                 Attendance_Group
   |                 Individual_Attendance
   |                 Dietary_Requirements
   |                 Staying_Onsite
   |                 Friday_Dinner
   |                 Final_Notes
   |                 RSVP_Timestamp
   |             - Redirect → thankyou.php
   |                     |
   |                     v
   |             thankyou.php (Short confirmation message)
   |                     |
   |                     v
   |             Redirect → main.php
   |
   |---> If RSVP already submitted
   |         v
   |     main.php (Main Dashboard)
   |         - Shows RSVP summary (pulled from Sheet)
   |         - Group 1 → Confirm accommodation
   |         - Group 2 → Reminder of £100/night
   |         - Group 3 → Confirm day attendance
   |         - May include “Update RSVP” option (optional)
   |
   v
[ Info Pages (navigation from main.php) ]
   - thebigday.php → Schedule
   - venue.php → Venue info
   - travel.php → Travel info
   - faq.php → FAQ
   - gifts.php → Gift list / registry
   - photos.php → Gallery (before/after wedding)