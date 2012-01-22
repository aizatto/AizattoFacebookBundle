README
======

This bundle provides entities to help store some Facebook data.

This bundle is expected to be used with an application that integrates
with Facebook, hence the dependenices on the FriendsOfSymfony (FOS) Bundles.


Installation
------------

### Install source code

You have two options to install the source code.

* deps file
* git submodules


#### Install via deps

Add into your deps file

<pre>
[FacebookSDK]
    git=git://github.com/facebook/php-sdk.git
    target=/facebook
[FOSUserBundle]
    git=git://github.com/FriendsOfSymfony/FOSUserBundle.git
    target=bundles/FOS/UserBundle
[FOSFacebookBundle]
    git=git://github.com/FriendsOfSymfony/FOSFacebookBundle.git
    target=/bundles/FOS/FacebookBundle
    version=origin/2.0
[AizattoFacebookBundle]
    git=http://github.com/aizatto/AizattoFacebookBundle.git
    target=/bundles/Aizatto/Bundle/FacebookBundle
</pre>

Execute vendor update script:

<pre>
php bin/vendors update
</pre>

#### Install via git submodules

Execute git submodule add command:

<pre>
git submodule add \
  https://github.com/facebook/php-sdk.git \
  vendor/facebook
git submodule add \
  https://github.com/FriendsOfSymfony/FOSUserBundle.git \
  vendor/bundles/FOS/UserBundle
git submodule add \
  --branch 2.0 \
  https://github.com/FriendsOfSymfony/FOSFacebookBundle.git \
  vendor/bundles/FOS/FacebookBundle
git submodule add \
  http://github.com/aizatto/AizattoFacebookBundle.git \
  vendor/bundles/Aizatto/Bundle/FacebookBundle
</pre>

### Install into AppKernel

Add "Aizatto\Bundle\FacebookBundle\FacebookBundle()" to the list of bundles.

<pre>
public function registerBundles()
{
    $bundles = array(
        new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
        ...
        new FOS\FacebookBundle\FOSFacebookBundle(),
        new FOS\UserBundle\FOSUserBundle(),
        new Aizatto\Bundle\FacebookBundle\FacebookBundle();
    );
</pre>

### Install into autoload

Edit app/autoload.php, and add the register the namespace "Aizatto":

<pre>
$loader->registerNamespaces(array(
  'Aizatto' => __DIR__.'/../vendor/bundles',
  'FOS'     => __DIR__.'/../vendor/bundles',
))
</pre>
