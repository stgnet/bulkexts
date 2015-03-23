bulkexts
========

create bulk extensions for testing FreePBX or Switchvox

Requirements
------------

Need a copy of the PHP (Faker)[https://github.com/fzaninotto/Faker]
for the generation of random names.

    # git clone https://github.com/fzaninotto/Faker

Instructions
------------

Modify the bulkext-default.csv as necessary to meet your needs.  Note
that only the first two lines (headers and first record) are used.

Modify create_bulk.php if needed to set other values or adjust the
number of records to create.

    # php create_bulk.php
    -or-
    # php create_swvx.php

The bulkext.csv or swvxext.csv now contains a large number of records that are ready
to be uploaded into FreePBX's or Switchvox's bulk extension upload tool.

