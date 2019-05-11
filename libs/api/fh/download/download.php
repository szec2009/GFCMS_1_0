<?php
header('Content-Type: application/jar');
header('Content-Type: application/apk');
header('Content-Disposition: attachment; filename="wherear_v15.apk"');
header('Content-Length: ' . filesize ("wherear_v15.apk"));
readfile('wherear_v15.apk');