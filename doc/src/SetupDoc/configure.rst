Shipping Methods
----------------

After `Installing the module`_, log in to your Magento® admin panel and navigate here:

::

    System -> Configuration -> Sales -> Shipping Methods -> DHL Express

Set the following configuration:

General Settings
~~~~~~~~~~~~~~~~

* *Enabled*: Activate this to use the module and display DHL Express live rates in the checkout.
* *Applicable Countries*: Select if you want to limit the allowed destination
  countries based on the Magento® default configuration, or by setting a custom list in
  the box *Allow for Specific Countries* below.
* *Logging*: Activate this to write messages to the log files in ``var/log``. Select the
  *Logging level* via the options below:

  * *Errors*: Only serious errors will be logged.
  * *Info*: Errors and warnings will be logged.
  * *Debug*: Log everything, including all API communication. This setting will create very
    large log files over time. **Only recommended for troubleshooting!**

.. admonition:: Log file

   Make sure to clear or archive the log file regularly. The module does not delete the log
   automatically. Personal data must only be stored as long as absolutely necessary. See also
   the section `Data protection`_.

DHL Express Account
~~~~~~~~~~~~~~~~~~~

* *Account number*: Enter your DHL Express account number.
* *API Credentials*: Enter the API username which you received from DHL Express.
* *Password*: Enter the password for the above API username.

.. raw:: pdf

   PageBreak

Shipping Preferences
~~~~~~~~~~~~~~~~~~~~

* *Allowed International Products*: Limit which international DHL Express products should be
  available in the checkout.
* *Allowed Domestic Products*: Limit which domestic DHL Express products should be available in
  the checkout.
* *Packaging Weight*: Enter a weight (kg) which will be added to the total shipment weight. The total
  weight will be used to calculate shipping rates.
* *Order Cut-off Time*: Orders which are placed before this time are expected to ship on the same
  day; orders placed afterwards are expected to ship on the following day. Holidays and weekends
  (globally between shipment origin and destination) are taken into account.
* *Pickup/Handover Time*: Set the time at which shipments are regularly handed over to or picked
  up by DHL.
* *Pickup Type*: Select if you have an agreement with DHL Express about regular pickups
  (e.g. every day at a fixed time), or ad-hoc pickups / drop-off at a service point.
* *Duties & Taxes*: Select who pays the duties and taxes for shipments.
* *Package Insurance*: Enable this to add insurance charges to the shipping price.
* *Minimum Cart Value*: If the cart value is equal to this or higher, shipping insurance will
  automatically be applied.

Checkout Presentation
~~~~~~~~~~~~~~~~~~~~~

* *Display Title*: Set the shipping method title which will be displayed in the checkout.
* *Sort Order*: Enter a number into this field to control the sorting of shipping methods
  in the checkout (optional).
* *Shipping Options Display*: Select what should be displayed in the checkout:

  * *Cost only*: Display only the shipping cost in the checkout.
  * *Cost and estimated delivery dates*: Display both shipping cost and estimated delivery dates.

* *If No DHL Shipping Option Available*: Select what should happen if the shipping method
  cannot be used:
  
  * *Hide this option from customer*
  * *Display customized message*. A message for the customer can be configured in the box below.

* *Round prices*: Select if and how the shipping rates should be rounded.
* *Rounding direction*: Select if prices should be rounded up or down.
* *Decimal Value*: If rounding to specific decimal value is selected, enter the value here without
  the decimal separator.

.. raw:: pdf

   PageBreak


Shipping Markup
~~~~~~~~~~~~~~~

* *International Shipping*: Enable this if you want to add markup (handling fees) for international
  shipments to the rates.
* *Calculate Markup*: Select if the markup should be added as a fixed amount, or
  calculated as a percentage offset. Enter the value in the box below.
* *Domestic Shipping*: Enable this if you want to add markup (handling fees) for domestic
  shipments to the rates.
* *Calculate Markup*: Select if the markup should be added as a fixed amount, or
  calculated as a percentage offset. Enter the value in the box below.

Free Shipping
~~~~~~~~~~~~~

* *Free Shipping Calculation*: Enable this to include virtual products in the minimum order value calculation.
* *International Orders*: Enable this to configure free shipping for international orders.
  Additional options will be displayed below.
* *Free Shipping Available For*: Select the allowed products for free shipping.
* *International Minimum Order Amount*: Enter the minimum value of the shopping cart required
  for free shipping. Leaving this empty will disable international free shipping.

* *Domestic Orders*: Enable this to configure free shipping for domestic orders.
  Additional options will be displayed below.
* *Free Shipping Available For*: Select the allowed products for free shipping.
* *Domestic Minimum Order Amount*: Enter the minimum value of the shopping cart required
  for free shipping. Leaving this empty will disable domestic free shipping.


.. raw:: pdf

   PageBreak

Shipping settings
-----------------

Log in to your Magento® admin panel and navigate here:

::

    System -> Configuration -> Sales -> Shipping settings -> Origin

Set the full address of your shop here:

* Country
* Region / state
* ZIP code
* City
* Street address


Currency configuration
----------------------

It is recommended to use the same Base Currency in Magento® as is
configured in your own DHL Express account settings.

You can configure your Magento® Base Currency here:

::

    System -> Configuration -> General -> Currency Setup -> Currency Options

.. image:: images/admin_base_currency.png
   :scale: 200%

Please refer to your DHL Express contact to find out which currency is
configured for your account.

The module will attempt to convert the currency configured in your DHL
Express account into your configured Base Currency. If you are using different base currencies
for individual Websites, make sure that all neccessary currency exchange rates
are configured here:

::

    System -> Manage Currency -> Rates

.. image:: images/admin_currency_rates.png
   :scale: 100%
