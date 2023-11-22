from selenium import webdriver
import os
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException
import time
tiempo_modulos=5
tiempo_carga=10
#driver Firefox
driver=webdriver.Firefox()

#Open URL
driver.get('https://192.168.9.78/')

#Maximize Window
driver.maximize_window()
time.sleep(5)
