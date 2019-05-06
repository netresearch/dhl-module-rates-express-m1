Before installation
-------------------

We strongly recommend making a complete backup of the shop's files and database before
any module installation or update.

Also, the installation and module functionality should be completely verified on a testing or
staging system before moving it into a production system.

If you want to use `Composer <https://getcomposer.org/>`_ to install a Magento® 1 module, you
need the `Magento® Composer Installer <https://github.com/Cotya/magento-composer-installer>`_.

.. admonition:: Please note

    Basic questions about setting up and using Composer in Magento® are not covered by our
    technical support. Please refer to the official documentation for Composer.


Installing the module
---------------------

Install the module's files according to your preferred setup/deployment strategy. It is
recommended to use a version control system (e.g. Git).

See below for options and details on installing the module.

Installation from package using Composer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If you got the module as a ``.zip`` or ``.tgz`` package, and the package **contains a 'composer.json' file**,
it is a so-called *Artifact* which can be installed with Composer.

You need the `Magento® Composer Installer <https://github.com/Cotya/magento-composer-installer>`_ for this.

Follow these steps:

* Copy (do not unzip) the package into a folder that is accessible by Composer.
* On the command line, navigate into the root folder of your Magento® installation.
* Execute the following commands:

::

    composer config repositories.dhl artifact /path/to/folder/with/zip/
    composer require dhl/module-rates-express-m1
    composer update

* Make sure that no Composer errors occurred. If there are any, they must be resolved.
* **Important:** the path in the above command is absolute, i.e. starting at the server (Linux) root. It must
  point to the folder, not to the package file itself.
* Then log out from the Magento® admin panel, and log in again.
* After this, clear all Magento® caches.
* Now proceed with the module `configuration`_.

Installation from package, manually
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If you have received the module as a ``.zip`` or ``.tgz`` package, and the package **does NOT contain a 'composer.json' file**,
you can install it manually.

Follow these steps:

* Unpack the package contents into your Magento® root directory.
* Verify that the module files have been copied into this directory:

::

    app/code/community/Dhl/ExpressRates

* Then log out from the Magento® admin panel, and log in again.
* After this, clear all Magento® caches.
* Now proceed with the module `configuration`_.

.. admonition:: Please note

    When installing the module this way, it is very important to use a version control system (e.g. Git). Otherwise, it
    will be more difficult to locate and remove the module files if you want to uninstall the module at a later time.

Installation from repository using Composer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The module is not yet available in a public repository.

Please choose another installation option.

.. raw:: pdf

   PageBreak

Installation using Modman
~~~~~~~~~~~~~~~~~~~~~~~~~

If you have the command line tool *modman* installed, you can use it to install the module.

Follow these steps:

* Extract the ``.zip`` or ``.tgz`` package into a directory that is accessible for modman.
* On the command line, navigate into the root folder of your Magento® installation.
* Execute the following commands:

::

    modman init
    modman link /path/to/extracted/module-rates-express-m1
    modman deploy module-rates-express-m1

* Then log out from the Magento® admin panel, and log in again.
* After this, clear all Magento® caches.
* Now proceed with the module `configuration`_.

Further info on *modman* installation without using a repository can be found here:

https://github.com/colinmollenhour/modman/wiki/Using-modman-without-git-or-svn

.. raw:: pdf

   PageBreak

Uninstalling the module
-----------------------
To **uninstall** the module, follow these steps:

1. Delete all module files from your file system
2. Remove all module entries ``carriers/dhlexpress/*`` from the table ``core_config_data``.
3. Flush the cache afterwards.

In case you only want to **disable** the module without uninstalling it, set the
node ``active`` in the file ``app/etc/modules/Dhl_ExpressRates.xml`` from **true**
to **false**.
