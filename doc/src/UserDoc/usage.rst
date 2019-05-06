Checkout workflow
-----------------

The checkout process works according to the Magento® standard behaviour:

* After entering the shipping address in the Magento® checkout, the module retrieves
  the available DHL Express products, depending on the module configuration and the
  shipping destination.
* The available shipping methods will be displayed. If none are visible, have a look
  at the `Troubleshooting`_ hints.
* The customer can select the desired DHL Express product.

.. image:: images/checkout_shipping.png
   :scale: 150 %

.. raw:: pdf

   PageBreak

* After clicking "Next", a summary of the selected shipping method and costs will be
  displayed.

.. image:: images/checkout_payment.png
   :scale: 150 %

* The customer can now click "Continue" to continue with the ordering process.

.. raw:: pdf

   PageBreak

Admin panel
-----------

Order overview
~~~~~~~~~~~~~~

Information about the DHL Express product for a particular order can be viewed in the
Magento® admin panel:

* Go to "*Sales -> Orders*", and open the desired order.
* Check the section "*Shipping & Handling Information*".

.. image:: images/admin_order_overview.png
   :scale: 110 %

.. raw:: pdf

   PageBreak

Creating a shipment
~~~~~~~~~~~~~~~~~~~

The workflow for creating a shipment is identical to the Magento® standard behaviour.

**Note**: This does not create a DHL shipment request or packaging label! See the
section about `Creating shipments / labels`_ for more information.
