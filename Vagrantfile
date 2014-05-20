# -*- mode: ruby -*-
# vi: set ft=ruby :
Vagrant.configure("2") do |config|
    config.vm.define :guest do |guest_config|
            guest_config.vm.box = "precise32"
            guest_config.vm.box_url = "http://files.vagrantup.com/precise32.box"
            guest_config.ssh.forward_agent = true

            # This will give the machine a static IP uncomment to enable
            #config.vm.network :private_network, ip: "192.168.131.2"
            #virtualbox__intnet: true
            guest_config.vm.network "public_network"
            guest_config.vm.network :forwarded_port, guest: 80, host: 8888, auto_correct: true
            guest_config.vm.network :forwarded_port, guest: 3306, host: 8889, auto_correct: true
            guest_config.vm.network :forwarded_port, guest: 5432, host: 5433, auto_correct: true
            guest_config.vm.hostname = "kotear"
            guest_config.vm.synced_folder "./", "/var/www", {:mount_options => ['dmode=777','fmode=777']}

            guest_config.vm.provider :virtualbox do |v|
                v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
                v.customize ["modifyvm", :id, "--memory", "1024"]
            end

            guest_config.vm.provision :puppet do |puppet|
                puppet.manifests_path = "provision/puppet/manifests"
                puppet.manifest_file  = "phpbase.pp"
                puppet.module_path = "provision/puppet/modules"
                #puppet.options = "--verbose --debug"
            end

            guest_config.vm.provision :shell, :path => "provision/puppet/scripts/enable_remote_mysql_access.sh"
    end
end
