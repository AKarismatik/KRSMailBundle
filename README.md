KRSMailBundle
=============
This bundle provides Templating and Attachment Decorating for SwiftMailer with Symfony
Template

The SwiftMailer template decorator, handles e-mail messages using the Symfony Templating Component.
AttachmentDecorator

The SwiftMailer attachment decorator is similar to Template decorator, but instead it handles attachments.
Installation
Step 1: Using Composer (recommended)

To install RollerworksMailBundle with Composer just add the following to your
composer.json file:

// composer.json
{
    // ...
    require: {
        // ...
        "krs/email-bundle": "dev-master",
    }
}

NOTE: Please replace master-dev in the snippet above with the latest stable

Then, you can install the new dependencies by running Composer's update
command from the directory where your composer.json file is located:

$ php composer.phar update

Now, Composer will automatically download all required files, and install them
for you. All that is left to do is to update your AppKernel.php file, and
register the new bundle:

<?php

// in AppKernel::registerBundles()
$bundles = array(
    // ...
    new KRS\MailBundle\KRSMailBundle(),
    // ...
);

