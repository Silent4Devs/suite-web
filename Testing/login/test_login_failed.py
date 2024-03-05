import pytest
import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

@pytest.fixture(scope="module")
def browser():
    driver = webdriver.Firefox()
    yield driver
    driver.quit()

def login(driver, username, password):
    driver.get('https://192.168.9.78/')
    driver.maximize_window()
    print("------ LOGIN ERRONEO - TABANTAJ -----")
    time.sleep(5)
    username_input = WebDriverWait(driver, 3).until(
        EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='email']"))
    )
    username_input.clear()
    username_input.send_keys(username)
    print("Usario ingresado")

    password_input = WebDriverWait(driver, 3).until(
        EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='password']"))
    )
    password_input.clear()
    password_input.send_keys(password)
    print("Contraseña ingresada")

    submit_button = WebDriverWait(driver, 3).until(
        EC.element_to_be_clickable((By.XPATH, "//button[@type='submit'][contains(text(),'Enviar')]"))
    )
    submit_button.click()
    print("Enviando credenciales de acceso")
    time.sleep(4)
    WebDriverWait(driver,3).until(
        EC.presence_of_element_located((By.XPATH, "//div[@class='invalid-feedback'][contains(.,'Estas credenciales no coinciden con nuestros registros.')]"))
    )
    print("Login incorrecto")

def test_login(browser):
    username = "prueba@prueba.com"
    password = "prueba3"

    login(browser, username, password)
