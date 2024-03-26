import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

class GestionContractual:
    def __init__(self, driver):
        self.driver = driver

    def login(self, username, password):
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("------ LOGIN - TABANTAJ -----")
        time.sleep(5)
        username_input = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='email']"))
        )
        username_input.clear()
        username_input.send_keys(username)
        print("Usario ingresado")

        password_input = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='password']"))
        )
        password_input.clear()
        password_input.send_keys(password)
        print("Contraseña ingresada")

        submit_button = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, "//button[@type='submit'][contains(text(),'Enviar')]"))
        )
        submit_button.click()
        print("Enviando credenciales de acceso")

        WebDriverWait(self.driver, 2).until(
            EC.presence_of_element_located((By.CSS_SELECTOR, "img[alt='Logo Tabantaj']"))
        )
        print("Login correcto")

    def open_menu(self):
        menu_btn = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//button[@class='btn-menu-header']"))
        )
        menu_btn.click()
    def go_to_gestion_contractual(self):
        gestion_contractual_btn = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "//a[@href='https://192.168.9.78/contract_manager/katbol']"))
        )
        time.sleep(0.5)
        gestion_contractual_btn.click()
        print("Botón de Gestion Contractual presionado")
        print("URL actual:", self.driver.current_url)
