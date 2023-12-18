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
#driver Firefox
driver=webdriver.Firefox()

#Open URL
driver.get('https://192.168.9.78/')

#Maximize Window
driver.maximize_window()
time.sleep(5)

#Registro de Visitantes
visitantes=driver.find_element(By.XPATH,"//a[@class='btn'][contains(@id,'visitantes')][contains(.,'Registro de Visitantes')]")
visitantes.click()

#Interfaz de regisro de visitantes
time.sleep(tiempo_modulos)
    #Registrar entrada
