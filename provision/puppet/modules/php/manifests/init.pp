class php
{
  $packages = [
    "php5",
    "php5-cli",
    "php5-mysql",
    "php-pear",
    "php5-dev",
    "php-apc",
    "php5-mcrypt",
    "php5-gd",
    "php5-curl",
    "libapache2-mod-php5",
    "php5-xdebug",
    "php5-sybase",
    #"php5-memcache",
    #"php5-memcached",
    #"php5-pgsql",
    "php5-intl",
    "php5-sqlite"
    ]

    package
    {
      $packages:
        ensure  => latest,
        require => [Exec['apt-get update']]
    }

    file
    {
      "/etc/php5/apache2/php.ini":
        ensure  => present,
        owner   => root, group => root,
        notify  => Service['apache2'],
        #source => "/vagrant/puppet/templates/php.ini",
        content => template('php/php.ini.erb'),
        require => [Package['php5'], Package['apache2']],
    }

    file
    {
      "/etc/php5/cli/php.ini":
        ensure  => present,
        owner   => root, group => root,
        notify  => Service['apache2'],
        content => template('php/cli.php.ini.erb'),
        require => [Package['php5']],
    }

}
