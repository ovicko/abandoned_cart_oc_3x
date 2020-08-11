# Abandoned Carts Recovery for Open Cart

This plugin was originally developed by [Angela](https://github.com/angela-d/abandoned-carts-opencart/) and I have taken the initiative of upgrading it to be fit for OpenCart 3.x

For Open Cart 3.x

For a list of improvements & fixes, see the [changelog](changelog.md).

Languages available:
* English

Features
* Self-extracting in OCMOD format
* Quick configuration (3 options!)
* Unique emails customized to the prospect; complete with their first name and cart contents
* No technical skill required for use; tick a checkbox, click send and you're done.

***


## [:link: Install Instructions](installing.md) ##

***

## Usage ##

On the next page load, you should see an alert indicating issues that may need your attention.  For each abandoned cart, the alert count will +1

![alerts](images/alerts.png)

By clicking the alerts icon, you will see a new Bailed Carts entry.  Following that link, will take you to a list of all unpaid shopping carts that meet your criteria set in the Abandoned Carts configuration.

![duplicate warning](images/navigation.png)

As you can see from this screenshot, the system automatically will notify you if this user has another order in the system -- one might indicate a successful checkout.  In such event, you want to ensure you don't send them an email from this screen without verifying they haven't already completed checkout (or already received a follow-up)!

To trigger an email, put a checkmark beside any user you would like to get in touch with.  Once you selected user(s), click the paper airplane icon on the upper right-hand side of the page and a follow-up email will be sent from you:
> Hi, Jane
>
> We noticed you stopped by our shop recently and didn't complete your purchase; we just wanted to make sure this wasn't in error -- if you meant to complete checkout, you didn't complete the payment process and thus your order wasn't placed.
>
> For your convenience, here's a list of what was in your cart:
1x MacBook
>
>
> If your bailed cart was intentional, we'd love to hear any feedback, suggestions or complaints you can offer so we can improve our store and customer experience!
>
>
>
> You received this message because you (or someone using your email address) recently stopped by our shop - you have not been added to any newsletter and will not receive further communication from us as a result of your order attempt (unless you explicitly signed up to our newsletter and/or product notifications). We do not forcefully sign people up to our communications.
> We thank you for your interest in our merch; have an excellent day!
>
> Regards,
>
> Your Store
>
> `https://yoursiteurl/`

You can customize the verbiage by directly editing the language file: [abandoned_carts.php](./upload/admin/language/en-gb/extension/module/abandoned_carts.php)

### Things to consider ###
If you changed your admin url to something other  than /admin (as *everyone* should!) be sure to unzip the extension *before* you install and modify any of the filepaths for admin/ to yourhiddenadminurl/ and re-package it (do not place it in a folder to re-zip!)

This extension should be multi-store compatible out of the box, but was *not* tested to ensure compatibility.

Tested in a single shopping cart environment running PHP 7.0+

## Help & Support ##
 I offer the following services at a negotiable fee:
 - Installation of this module and other OpenCart modules
 - Upgrading modules/extensions
 - Bug Fixing OpenCart websites,themes etc
 - Payment Gateway Integrations
 
 Contact thehomestra@gmail.com for help

### Note ###
You do not need to clone this repository to utilize the plugin, all you have to do is download the
[zip file](./../../releases).

You can also download previous versions from the [Open Cart Marketplace](https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=33561).

I included the source in this repository for those who like to review the codebase prior to using new code.

### Language Info ###
The language the email is sent to the recipient in, is dependent upon the language of their 'profile' as they visited the site (which is typically the default language of the front-end of your store.)

If you would like to contribute a new language pack, please see [contributing info](CONTRIBUTING.md).

