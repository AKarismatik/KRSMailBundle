KRSMailBundle
=============

The symfony2 KRSMailBundle provide an easy way to manage application email templates.

Features include:

- Manage Email Templates
- Generate Sonata Admin



Getting started with KRSMailBundle
==================================

The symfony2 KRSMailBundle provide an easy way to manage application email templates.
Mail templates

When sending a mail with symfony, you generally write the mail body in a file template.
The mail subject is also frequently hard-coded in an action, as well as "from" and "to" emails.
The problem is that the developper is responsible for writing and maintaining all these values.
Each time the customer wanna change the mail body, he depends on the developper.

The goal is to let a non-developper manage sent mails, by moving all mail attributes from the code to the database.

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
$ php composer.phar update krs/mail-bundle
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

## Send a mail using a mail template

Mails are generally sent from a symfony action.
Suppose you want to send a mail to a registered user when (s)he signs up a petition.
```php
$this->get('krs.mailer')                 // get a KRSMail instance  
->setTemplate('karis_mail_confirmation') // choose a KRSMailTemplate  
->addValues(array(                          // add values to populate the template  
  'user_name'       => $user->username,  
  'user_email'      => $user->email,  
  'petition_name'   => $petition->name  
))  
->send();   
```
The first time your run this code, the "karis_mail_confirmation" mail template does not exist, and gets created automatically.

## Configure the template

Now you need to modify it in Admin->Tools->Mail templates. A Mail template has the following fields:

### Name

The unique name of the template, used in your PHP code to identify it.
eg. "sign_petition_confirmation"

###Description

Short description to help you remember what this mail template is used to.
eg. "Congrat a user who just signed up a petition"

Active

Whether to send emails that use this template or not.

### Subject

The one-line mail subject.
eg. "Hello, dear %user_name%"

### Body

The mail body.
eg. "Thanks for signing the petition %petition_name%!"

### From Email

The "from" header of the mail.
eg.

```webmaster@mysite.com ```
you can use several email adresses, both static and variables one, and provide both name and email.

```other-mail@domain.com, %user_email%, Sergio <sergio@mysite.com>```  
### To Email

The email, or list of emails, that will receive the mail.
eg.

```%user_email% ```
### The variables

When you configure a mail template with the admin interface, you see the available variables you can use in the template fields.
With the current example, you can use the variables: %user_name%, %user_email%, %petition_name%.
You don't need to manage manually this list of available variables. They are automatically updated if needed when you render a mail, using the values array:
```
->addValues(array(                        // add values to populate the template  
  'user_name'       => $user->username,  
  'user_email'      => $user->email,  
  'petition_name'   => $petition->name  
))  
```
More ways to pass values

In the previous example, we pass values to the template with a simple PHP array:
```
->addValues(array(                        // add values to populate the template  
  'user_name'       => $user->username,  
  'user_email'      => $user->email,  
  'petition_name'   => $petition->name  
))  

/*  
 * Values available in the template:  
 * %user_name%, %user_email%, %petition_name%  
 */  
```
You can also use a Doctrine record or a Doctrine form.
In this case, the table columns are used as keys, and the object values as values.
```
->addValues($user) // $user is an instance of the DmUser model, which extends DoctrineRecord
/*  
 * Values available in the template:  
 * %username%, %email%, %is_active%, ...  
 */  ```
You can call the addValues() method several times, and pass it a prefix as a second argument:
```
->addValues($user, 'user_')
->addValues($petition, 'petition_')  
->addValues(array(  
  'petition_url' => $this->getHelper()->link($petition)->getAbsoluteHref()  
))  

/*  
 * Values available in the template:  
 * %user_username%, %user_email%, %user_is_active%, %petition_name%, %petition_text%, %petition_url%  
 */ 
```
