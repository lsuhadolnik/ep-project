#!/bin/bash

country="SI"
state="Ljubljana"
loc="Ljubljana"
org="EP"
ou="IT"
cn="hello.local"

str="/C=$country/ST=$state/L=$loc/O=$org/OU=$ou"



# Chrome extensions...
#--------------------------
v3ext=$(cat <<HERE
authorityKeyIdentifier=keyid,issuer
basicConstraints=CA:FALSE
keyUsage = digitalSignature, nonRepudiation, keyEncipherment, dataEncipherment
subjectAltName = @alt_names

[alt_names]
DNS.1 = $cn
HERE
)
echo "$v3ext" > "v3.ext"
#--------------------------


# Create the CA Key and Certificate for signing Client Certs
openssl genrsa -out ca.key 4096
openssl req -new -x509 -days 365 -key ca.key -out ca.crt \
-subj "$str/CN=EP prodajalna"

# Create the Server Key
openssl genrsa -out server.key 1024
openssl req -new -key server.key -out server.csr \
-subj "$str/commonName=$cn/"

# We're self signing our own server cert here.  This is a no-no in production.
openssl x509 -req -days 365 -in server.csr \
-CA ca.crt -CAkey ca.key -set_serial 01 \
-sha256 -extfile v3.ext -out server.crt
# --------------------------------


# Generate Admin client
cl_name="admin"
openssl genrsa -out "$cl_name.key" 1024
openssl req -new -key "$cl_name.key" -out "$cl_name.csr" \
-subj "/emailAddress=$cl_name@ep.si$str/CN=$cl_name"

# Sign the certificate
openssl x509 -req -days 365 -in "$cl_name.csr" -CA ca.crt -CAkey ca.key -set_serial 02 -out "$cl_name.crt"
openssl pkcs12 -export -nodes -clcerts -in "$cl_name.crt" -inkey "$cl_name.key" -out "$cl_name.p12" -passout pass:
# --------------------------------------------

# Generate Prodajalec client
cl_name="prod"
openssl genrsa -out "$cl_name.key" 1024
openssl req -new -key "$cl_name.key" -out "$cl_name.csr" \
-subj "/emailAddress=$cl_name@ep.si$str/CN=$cl_name"

# Sign the certificate
openssl x509 -req -days 365 -in "$cl_name.csr" -CA ca.crt -CAkey ca.key -set_serial 03 -out "$cl_name.crt"
openssl pkcs12 -export -nodes -clcerts -in "$cl_name.crt" -inkey "$cl_name.key" -out "$cl_name.p12" -passout pass:
# --------------------------------------------
