<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.
/*
    Copyright 2014 Rustici Software

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
*/
if (file_exists('vendor/autoload.php')) {
    // prefer the composer autoloader
    require_once('vendor/autoload.php');
}
else if (!class_exists('cmi5\\Version')) {
    cmi5_register_autoloader('cmi5\\', 'src');
}

/**
 * Register a namespace autoloader for the cmi5 library
 *
 * A source filepath will be generated based on the current directory.
 *
 * @param string $namespace a valid namespace, include trailing backslashes ('\\')
 * @param string $directory a directory name, not a filepath
 * @package mod_cmi5launch
 */
function cmi5_register_autoloader($namespace, $directory) {
    spl_autoload_register(function($classname) use ($namespace, $directory) {
        if (stripos($classname, $namespace) === false) {
            return;
        }
        $sourcedir = __DIR__ . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR;
        $filename  = str_replace([$namespace, '\\'], [$sourcedir, DIRECTORY_SEPARATOR], $classname) . '.php';
        if (is_readable($filename)) {
            include $filename;
        }
    });
}
