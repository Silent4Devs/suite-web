from selenium import webdriver
import os
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import TimeoutException

driver.add_argument('--headless')

driver = webdriver.FirefoxOptions()

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

#Login
usr=driver.find_element(By.XPATH,"//input[contains(@name,'email')]").send_keys("zaid.garcia@becarios.silent4business.com")
time.sleep(tiempo_modulos)
pw=driver.find_element(By.XPATH,"//input[contains(@name,'password')]").send_keys("ranas289")
time.sleep(tiempo_modulos)
btn=driver.find_element(By.XPATH,"//button[@type='submit'][contains(.,'Enviar')]")
btn.click()
