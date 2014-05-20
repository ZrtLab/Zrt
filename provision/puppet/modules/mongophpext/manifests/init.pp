class mongophpext {
    package { "make": 
        ensure => present,
        require => [ Package['php5'], Package['php5-dev'], Package['php-pear'] ]
    }

    exec { "pecl install mongo":
      command => "pecl install 'mongo-1.4.1'",
      path => "/usr/bin/",
      require => [Package["make"]],
      unless => 'pecl info mongo'
    }

    file { "/etc/php5/conf.d/mongo.ini":
      content=> 'extension=mongo.so',
      require => [Exec["pecl install mongo"]],
    }
}
