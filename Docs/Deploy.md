
# Basic Laravel routes

Enable mod rewrite:
```bash
sudo a2enmod rewrite
```

```apache
DocumentRoot /var/www/ep_projekt/public
     <Directory /var/www/ep_projekt/public>
         AllowOverride all
     </Directory>
```

# Apache HTTPS
```bash
sudo a2enmod ssl
sudo service apache2 restart

# run gencerts.sh inside certs folder

sudo vim /etc/apache2/sites-available/default-ssl.conf
```

```apache

        DocumentRoot /var/www/ep_projekt/public
		<Directory /var/www/ep_projekt/public>
        	 AllowOverride all
	    </Directory>

		<LocationMatch "^(/api)?/secure(/(.*))?">
			
			SSLVerifyClient require
			SSLVerifyDepth 1
			SSLOptions +StdEnvVars

		</LocationMatch>

        SSLCACertificateFile	/var/www/ep_projekt/certs/ca.crt
		SSLCertificateFile	/var/www/ep_projekt/certs/server.crt
		SSLCertificateKeyFile /var/www/ep_projekt/certs/server.key
```

Potem
```bash
sudo ln -s /etc/apache2/sites-available/default-ssl.conf /etc/apache2/sites-enabled/default-ssl.conf
sudo service apache2 restart
```
