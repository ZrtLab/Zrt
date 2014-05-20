class vim {
    package { 'vim':
        ensure => installed,
        require => Exec['apt-get update']
    }
}
