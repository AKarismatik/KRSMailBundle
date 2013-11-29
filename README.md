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


### Send mails

To send mails

Mail templates

Send a mail using a mail template

Mails are generally sent from a symfony action.
Suppose you want to send a mail to a registered user when (s)he signs up a petition.
```php
$this->getContainer()->get('krs.mailer')              // get a krs Mail instance  
->setTemplate('kars_mail_confirmation') // choose a krsMailTemplate  
->addValues(array(                          // add values to populate the template  
  'user_name'       => $user->getuserName(),  
  'user_email'      => $user->getEmail()
))  
->send();                                   // send the mail using Swift Mailer  

```
The first time your run this code, the "kars_mail_confirmation" mail template does not exist, and gets created automatically.

### Configure the template


