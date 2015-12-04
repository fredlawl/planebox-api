# PlaneBox API

Repository for the PlaneBox API. This API is a part of the CSC450 Software Engineering course.

Developers:

* Mohammed Alotaib
* Matthew Higgins
* Frederick Lawler
* Christopher Weddle
* Dan West

## Installation

### Requirements
The following software is required to optimally install this API on a machine.

* MySQL
* Apache2
* PHP5.5 (or greater)

### Steps

1. Clone repository into desired location on your machine
2. Setup a MySQL Database
3. Download and Install [Composer](https://getcomposer.org/)
    * Follow install instructions [here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) _it is recommended to install composer globally on your machine_
4. Run `composer install` within the root directory of the project.
5. Configure an Apache2 [vhost](https://httpd.apache.org/docs/2.2/vhosts/examples.html) and point it to the directory where this repository was cloned into. 
    * _**NOTE:**_ The document root should be pointed to the path `/path/to/project/plublic`

6. Read Laravel’s [Environment Configuration](http://laravel.com/docs/5.0/configuration#environment-configuration)
   * There is a file called `.evn-example` that should be copied to `.env` and setup configuration options for the Database. Located in the root directory.
   * If you need an app-key, type `php artisan key:generate` to get a key for the application
7. Run `php artisian migrate` to install/setup the database
   * To create an administrator account, create an account through the [PlaneBox](https://github.com/fredlawl/planebox) app, and set the flag in the database for the `admistrator` column to 1.
8. Done

## Development

This API was built with [Laravel](http://laravel.com/docs/5.0). In addition to following the install instructions, the Laravel documentation must be read as well.

## License
PlaneBox (c) by Frederick Lawler, Dan West, Mohammed Alotaibi, Matthew Scott, Christopher Weddle

PlaneBox is licensed under a
Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License.

You should have received a copy of the license along with this
work.  If not, see <http://creativecommons.org/licenses/by-nc-nd/3.0/>.

Creative Commons Legal Code

Attribution-NonCommercial-NoDerivs 3.0 Unported

Laravel falls under the MIT License
