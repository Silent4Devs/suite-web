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
    print("Login del aplicativo Tabantaj - INICIANDO")
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

    WebDriverWait(driver, 2).until(
        EC.presence_of_element_located((By.CSS_SELECTOR, "img[alt='Logo Tabantaj']"))
    )
    print("Login correcto")

def test_login(browser):
    username = "admin@admin.com"
    password = "#S3cur3P4$$w0Rd!"

    login(browser, username, password)

