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

def login(driver, username, password, email):
    driver.get('https://192.168.9.78/')
    driver.maximize_window()
    print("------ Login recuperar contraseña aplicativo Tabantaj - INICIADO -----")
    time.sleep(5)
    #USUARIO
    print("URL actual:", driver.current_url)
    username_input = WebDriverWait(driver, 2).until(
        EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='email']"))
    )
    username_input.clear()
    username_input.send_keys(username)
    print("Usario ingresado")

    #PASSWORD
    password_input = WebDriverWait(driver, 2).until(
        EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='password']"))
    )
    password_input.clear()
    password_input.send_keys(password)
    print("Contraseña ingresada")

    #BOTÓN ENVIAR
    submit_button = WebDriverWait(driver, 2).until(
        EC.element_to_be_clickable((By.XPATH, "//button[@type='submit'][contains(text(),'Enviar')]"))
    )
    submit_button.click()
    print("Enviando credenciales de acceso")

    time.sleep(2)
    WebDriverWait(driver,1).until(
        EC.presence_of_element_located((By.XPATH, "//div[@class='invalid-feedback'][contains(.,'Estas credenciales no coinciden con nuestros registros.')]"))
    )
    print("Login incorrecto")

    #¿OLVIDÓ SU CONTRASEÑA?
    print("Recuperando contraseña")
    time.sleep(2)
    fg_button = WebDriverWait(driver, 1).until(
        EC.element_to_be_clickable((By.XPATH, "//a[@class='btn'][contains(.,'¿Olvidó su contraseña?')]"))
        )
    fg_button.click()

    #RECUERAR CONTRASEÑA
    print("URL actual:", driver.current_url)
    print("Redirigiendo a recuperar contraseña")

    email_input = WebDriverWait(driver, 1).until(
        EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='email']"))
    )
    email_input.clear()
    email_input.send_keys(email)
    print("Correo ingresado")

    recuperar_button = WebDriverWait(driver, 1).until(
        EC.element_to_be_clickable((By.XPATH, "//button[@type='submit'][contains(.,'Recuperar contraseña')]")
    ))
    recuperar_button.click()
    print("URL actual:", driver.current_url)

def test_login(browser):
    username = "prueba@prueba.com"
    password = "prueba1"
    email="admin@admin.com"

    login(browser, username, password, email)
