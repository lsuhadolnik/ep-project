
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
sem kopiraj isto kot zgoraj (Basic Laravel routes) in nastavi pravilno pot do `.crt` in `.key` datoteke.

Potem
```bash
sudo ln -s /etc/apache2/sites-available/default-ssl.conf /etc/apache2/sites-enabled/default-ssl.conf
sudo service apache2 restart
```
