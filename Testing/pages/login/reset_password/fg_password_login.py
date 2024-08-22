import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

class FgPasswordLogin:
    def __init__(self, driver):
        self.driver = driver

    def fg_password_login(self):
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("------ FORGOT PASSWORD LOGIN - TABANTAJ -----")
        time.sleep(4)
        fg_password_btn= WebDriverWait(self.driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, "//a[@class='btn' and @href='https://192.168.9.78/password/reset']"))
        )
        fg_password_btn.click()
        print("Botón de recuperación de contraseña presionado")
    def email_input(self,email_fg):
        email_input = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//input[@id='email' and @type='email']"))
        )
        email_input.clear()
        email_input.send_keys(email_fg)
        print("Correo electrónico ingresado")
    def submit_button(self):
        submit_button = WebDriverWait(self.driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, "//button[@type='submit' and @class='btn_enviar']"))
        )
        submit_button.click()
        print("Enviando correo de recuperación de contraseña")
