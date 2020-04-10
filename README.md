# Event Viewer

A Laravel package that can be used to view event streams

## Install



## Setup

- `php artisan vendor:publish`
- config `config/event-viewer.php`
- view '/event-viewer'

## Authorization

 By default, you will only be able to access this view in the local environment.
 Within your `config/event-viewer.php` file, there is a `accessEmails` option. This option controls access to EventViewer in **non-local** environments. You are free to modify this option as needed to restrict access to your EventViewer.