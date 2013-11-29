KRSMailBundle
=============

The symfony2 KRSMailBundle provide an easy way to manage application email templates.

Features include:

- Manage Email Templates
- Generate Sonata Admin


Documentation
-------------
Getting started with KRSMailBundle
==================================

The symfony2 KRSMailBundle provide an easy way to manage application email templates.


## Installation

### Step 1: Download KRSMailBundle using composer

Add JmABBundle in your composer.json:

```js
{
    "require": {
       "krs/mail-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update rj/email-bundle
```

Composer will install the bundle to your project's `vendor/krs` directory.


### Step 2: Enable the bundle
```php
public function registerBundles()
{
    $bundles = array(
        // ...
       new KRS\MailBundle\KRSMailBundle(),
    );
}
```


### Send mails

To send mails, Diem obviously uses symfony 1.4 default mailer: Swift.
So you can use it the same way you would do with symfony.

But Diem also offers additional features on top of symfony mailer.

Mail templates

When sending a mail with symfony, you generally write the mail body in a file template.
The mail subject is also frequently hard-coded in an action, as well as "from" and "to" emails.
The problem is that the developper is responsible for writing and maintaining all these values.
Each time the customer wanna change the mail body, he depends on the developper.

Diem features a Mail template module.
The goal is to let a non-developper manage sent mails, by moving all mail attributes from the code to the database.

Send a mail using a mail template

Mails are generally sent from a symfony action.
Suppose you want to send a mail to a registered user when (s)he signs up a petition.
```php
$this->getService('mail')                 // get a dmMail instance  
->setTemplate('sign_petition_confirmation') // choose a DmMailTemplate  
->addValues(array(                          // add values to populate the template  
  'user_name'       => $user->username,  
  'user_email'      => $user->email,  
  'petition_name'   => $petition->name  
))  
->send();                                   // send the mail using Swift Mailer  

```
The first time your run this code, the "sign_petition_confirmation" mail template does not exist, and gets created automatically.

### Configure the template

Now you need to modify it in Admin->Tools->Mail templates. A Mail template has the following fields:

Name

The unique name of the template, used in your PHP code to identify it.
eg. "sign_petition_confirmation"

Description

Short description to help you remember what this mail template is used to.
eg. "Congrat a user who just signed up a petition"

Active

Whether to send emails that use this template or not.

Subject

The one-line mail subject.
eg. "Hello, dear %user_name%"

Body

The mail body.
eg. "Thanks for signing the petition %petition_name%!"

From Email

The "from" header of the mail.
eg.

webmaster@mysite.com  
you can use several email adresses, both static and variables one, and provide both name and email.

other-mail@domain.com, %user_email%, Sergio <sergio@mysite.com>  
To Email

The email, or list of emails, that will receive the mail.
eg.

%user_email%  
you can use several email adresses, both static and variables one, and provide both name and email.

other-mail@domain.com, %user_email%, Sergio <sergio@mysite.com>  
Other advanced fields are available to send carbon copies and/or customize the mail headers.

### The variables

When you configure a mail template with the admin interface, you see the available variables you can use in the template fields.
With the current example, you can use the variables: %user_name%, %user_email%, %petition_name%.
You don't need to manage manually this list of available variables. They are automatically updated if needed when you render a mail, using the values array:

->addValues(array(                        // add values to populate the template  
  'user_name'       => $user->username,  
  'user_email'      => $user->email,  
  'petition_name'   => $petition->name  
))  
More ways to pass values

In the previous example, we pass values to the template with a simple PHP array:

->addValues(array(                        // add values to populate the template  
  'user_name'       => $user->username,  
  'user_email'      => $user->email,  
  'petition_name'   => $petition->name  
))  
/*  
 * Values available in the template:  
 * %user_name%, %user_email%, %petition_name%  
 */  
You can also use a Doctrine record or a Doctrine form.
In this case, the table columns are used as keys, and the object values as values.

->addValues($user) // $user is an instance of the DmUser model, which extends DoctrineRecord
/*  
 * Values available in the template:  
 * %username%, %email%, %is_active%, ...  
 */  
You can call the addValues() method several times, and pass it a prefix as a second argument:

->addValues($user, 'user_')
->addValues($petition, 'petition_')  
->addValues(array(  
  'petition_url' => $this->getHelper()->link($petition)->getAbsoluteHref()  
))  
/*  
 * Values available in the template:  
 * %user_username%, %user_email%, %user_is_active%, %petition_name%, %petition_text%, %petition_url%  
 */  
Advanced usage

Internals

When you call

$mail = $this->getService('mail')
->setTemplate('my_mail_template_code');  
you create an instance of dmMail. A dmMail instance has:
- a DmMailTemplate
- values to populate the template
- a Swift_Message instance

When you call

$mail->send();
The dmMail->render() method is automatically called.
The render() method uses the DmMailTemplate and the values to fill the Swift_Message attributes, then the message is sent using Swift.

Access the Swift_Message

If you want to modify the Swift_Message before sending it, you can do:

$mail = $this->getService('mail')
->setTemplate('my_mail_template_code')  
->addValues(...)  
->render();  
 
$message = $mail->getMessage(); // @return Swift_Message the message instance  
// manipulate the $message  
 
$mail->send(); // send the message  
Attach files

As you can access the Swift_Message, you can attach files normally:

$mail = $this->getService('mail')
->setTemplate('my_mail_template_code')  
->addValues(...)  
->render();  
 
// Get the Swift_Message and add an attachement  
$mail->getMessage()->attach(Swift_Attachment::fromPath('path/to/file.pdf'));  
 
$mail->send(); // send the message 

