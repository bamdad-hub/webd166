CHAPTER 10 — THE PIZZA FUNCTION CHALLENGE
=========================================

CONTENTS
  pizza_order.html  — the completed HTML pizza form
  order_me.php      — the working Chapter 7 PHP processor, with Team A/Team B guidance

IMPORTANT
These are the SAME starting files for both teams. They already work and do not
contain completed user-defined functions. Do not replace this starter with
an unfinished Chapter 7 homework file.

RUN WITH XAMPP
1. Extract this ZIP into C:\xampp\htdocs\webd166\chapter10\
2. Start Apache in the XAMPP Control Panel.
3. Visit http://localhost/webd166/chapter10/pizza_order.html
4. Submit the form and confirm the results appear.

TEAM A — PIZZA PRICE CALCULATOR
Locate the marked price-calculation section in order_me.php.
Turn it into a reusable function, call the function, and keep the same totals.
Test 0 toppings ($7.95), 2 toppings ($9.95), and 4 toppings ($11.95).

TEAM B — TOPPING VALIDATION
Locate the marked approved-topping loop in order_me.php.
Turn that logic into a reusable function, call it, and retain the original
rules: only string topping keys listed in $allowedToppings are accepted.
Preserve the associative keys and display values; count only approved toppings.

TESTING NOTES
- Check no toppings, 2 toppings, 4 toppings, and an unapproved topping
  submitted through an HTTP request or development test.
- The HTML form itself only offers approved toppings, so it cannot select
  an unapproved value without a modified request.
- Do not include completed function solutions in your initial group proposal.
- Share proposals and peer feedback in your class-wide Canvas discussion.
- Submit the GitHub repository URL; do not submit a ZIP file.

SOURCE
Based on the uploaded completed Chapter 7 instructor file pizza_order.php
and uploaded form order.html; filenames and links are standardized for
Chapter 10, and user-supplied name/phone data are checked before trimming.
The underlying topping validation and price calculation are preserved.

NOTE
The pizza photo in the HTML uses the original externally hosted image URL.
It may not load when the remote site is unavailable; this does not affect PHP.
