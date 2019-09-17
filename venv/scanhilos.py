import os
import sys
import platform
import threading, subprocess
import mysql.connector
from datetime import datetime

conexion1=mysql.connector.connect(host="localhost",
                                  user="root",
                                  passwd="",
                                  database="pyprueba")
cursor1=conexion1.cursor()


IPXHILOS = 4
ip = input("Ingresa la IP: ")
ipDividida = ip.split('.')

try:
    red = ipDividida[0] + '.' + ipDividida[1] + '.' + ipDividida[2] + '.'
    comienzo = int(input("Ingresa el número de comienzo de la subred: "))
    fin = int(input("Ingresa el número en el que deseas acabar el barrido: "))
except:
    print("[!] Error")
    sys.exit(1)

if (platform.system() == "Windows"):
    ping = "ping -n 1"
else:
    ping = "ping -c 1"


class Hilo(threading.Thread):
    def __init__(self, inicio, fin):
        threading.Thread.__init__(self)
        self.inicio = inicio
        self.fin = fin

    def run(self):
        for subred in range(self.inicio, self.fin):
            direccion = red + str(subred)
            response = os.popen(ping + " " + direccion)
            for line in response.readlines():
                if ("ttl" in line.lower()):
                    print(direccion, "está activo")
                    cursor1.execute("insert into `ips`(`ips_val`) VALUES ("+direccion+")")

                    break


tiempoInicio = datetime.now()
print("[*] El escaneo se está realizando desde", red + str(comienzo), "hasta", red + str(fin))
NumeroIPs = fin - comienzo
numeroHilos = int((NumeroIPs / IPXHILOS))
hilos = []

try:
    for i in range(numeroHilos):
        finAux = comienzo + IPXHILOS
        if (finAux > fin):
            finAux = fin
        hilo = Hilo(comienzo, finAux)
        hilo.start()
        hilos.append(hilo)
        comienzo = finAux
except Exception as e:
    print("[!] Error creando hilos:", e)
    sys.exit(2)

for hilo in hilos:
    hilo.join()

tiempoFinal = datetime.now()
tiempo = tiempoFinal - tiempoInicio
print("[*] El escaneo ha durado %s" % tiempo)
conexion1.close()