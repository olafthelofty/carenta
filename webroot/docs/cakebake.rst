Initial setup for utility tables
================================

Don't use `FriendsOfCake <https://github.com/FriendsOfCake/crud/>`_ CRUD plugin

Example below uses Shifts

Step 1 - Create your tables using migrations
--------------------------------------------
Create your tables using migrations:

.. code-block:: console

   # ./bin/cake bake migration CreateShifts name:string created modified
   # ./bin/cake migrations migrate
   
Step 2 - Bake your model
------------------------

.. code-block:: console

   # ./bin/cake bake model Shifts
   
Step 3 - Bake your controller
-----------------------------

.. code-block:: console

   # ./bin/cake bake controller Shifts 
    
Step 4 - Bake your views
------------------------

This will create a full set of CRUD views using the BootstrapUI theme

.. code-block:: console

   $ ./bin/cake bake template Shifts -t BootstrapUI 
   
Step 5 - Keep your nav bar up to date
-------------------------------------

Edit your nav bar at:

/var/www/vhosts/somervillehouse.co.uk/carenta/src/Template/Layout/TwitterBootstrap/dashboard.ctp
   