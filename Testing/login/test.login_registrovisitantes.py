from selenium import webdriver
import os
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import TimeoutException
import time
tiempo_modulos=4
tiempo_carga=10
tiempo_espera=2.5
registar_visitantes_xpath="//a[@class='btn'][contains(@id,'visitantes')][contains(.,'Registro de Visitantes')]"
entrada_xpath="//a[contains(.,'Registrar Entrada')]"
salida_xpath="//a[contains(.,'Registrar Salida')]"
#driver Firefox
driver=webdriver.Firefox()

#Open URL
driver.get('https://192.168.9.78/')

#Maximize Window
driver.maximize_window()
time.sleep(5)

#Registro de Visitantes
print("Entrando a Determinacion de alcance ...")
visitantes= driver.find_element(By.XPATH, registar_visitantes_xpath)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, registar_visitantes_xpath)))
print("Dando clic en Determinacion de alcance  ..")
visitantes.click()

    #Registrar entrada
print("Entrando a Registrar entrada ...")

try:
    entrada = driver.find_element(By.XPATH, entrada_xpath)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, entrada_xpath)))
    entrada.click()
except Exception as e:
    print(f"Error al interactuar con el botón {e}")

#finally:
    # Cerrar el navegador al finalizar
    #driver.quit()

#Registrar salida
#print("Entrando a Registrar salida ...")

#try:
    #salida = driver.find_element(By.XPATH, salida_xpath)
    #WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, salida_xpath)))
    #salida.click()
#except Exception as e:
    #print(f"Se produjo una excepción al registrar salida: {e}")

