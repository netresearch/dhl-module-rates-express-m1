Creating shipments / labels
---------------------------

The module only displays the available DHL Express rates in the checkout and allows the
customer to select the desired product. It does **not** transmit the full shipment information
to DHL or create shipment requests (packaging labels).

To get and print DHL packaging labels, the shipment information needs to be exported from
Magento® to DHL Express via a third-party system.

Technically, DHL Express is an offline shipping method.

Language support
----------------

The module supports the locale ``en_US``. Translations are stored
in CSV translation files and can therefore be modified by third-party modules.

Data protection
---------------

The module transmits personal data to DHL Express which are needed to calculate the
rates.

The merchant needs the agreement from the customer to process the data, e.g. via the shop's
terms and conditions and / or an agreement in the checkout (Magento® Checkout Agreements).

The actual data which is transmitted can be seen in the log file in ``var/log``
(see `General settings`_).
