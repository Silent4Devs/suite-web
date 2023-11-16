from selenium import webdriver
import os
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
import time
tiempo=1
#driver Firefox
driver=webdriver.Firefox(executable_path=r'C:/Users/zaid.garcia/Downloads/geckodriver-v0.33.0-win64/geckodriver.exe')

#Abre la pagina
driver.get('http://tabantaj.test/')

#maximizar Pantalla
driver.maximize_window()
time.sleep(7)

#LOGIN
usr=driver.find_element(By.XPATH,"//input[contains(@name,'email')]").send_keys("zaid.garcia@becarios.silent4business.com")
time.sleep(tiempo)
pw=driver.find_element(By.XPATH,"//input[contains(@name,'password')]").send_keys("$QB&kT3&R4")
time.sleep(tiempo)
btn=driver.find_element(By.XPATH,"//button[@type='submit'][contains(.,'Enviar')]")
btn.click()
