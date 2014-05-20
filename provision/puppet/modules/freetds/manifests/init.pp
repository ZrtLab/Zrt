class freetds {
    package { 'freetds-common':
        ensure => installed,
        require => Exec['apt-get update']
    }
    
    package { 'freetds-bin':
        ensure => installed,
        require => Exec['apt-get update']
    }
    
    package { 'unixodbc':
        ensure => installed,
        require => Exec['apt-get update']
    }
}
