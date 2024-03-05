import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC


class RegistroVisitantesLogin:
    def __init__(self, driver):
        self.driver = driver

    def registro_visitantes_login(self, nombre,apellido,correo,telefono):
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("------ REGISTRO DE VISITANTES - TABANTAJ -----")
        time.sleep(7)
        registro_visitantes_btn= WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//a[contains(.,'Registro de Visitantes')]"))
        )
        registro_visitantes_btn.click()
        print("URL actual:", self.driver.current_url)
        registro_entrada_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//a[contains(@href, 'visitantes') and contains(@class, 'rounded')]"))
        )
        registro_entrada_btn.click()
        print("Botón de registro de entrada presionado")
        print("URL actual:", self.driver.current_url)
        aceptar_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//button[contains(.,'Acepto')]"))
        )
        aceptar_btn.click()
        nombre_input = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//input[@id='nombre']"))
        )
        nombre_input.clear()
        time.sleep(5)
        nombre_input.send_keys(nombre)
        print("Nombre ingresado")

        apellido_input = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.XPATH, "//input[@id='apellido']"))
        )
        apellido_input.clear()
        time.sleep(5)
        apellido_input.send_keys(apellido)
        print("Apellido ingresado")
        correo_input = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.XPATH, "//input[@id='correo']"))
        )
        correo_input.clear()
        correo_input.send_keys(correo)
        time.sleep(5)
        print("Correo electrónico ingresado")
        telefono_input = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.XPATH, "//input[@id='celular']"))
)
        telefono_input.clear()
        time.sleep(5)
        telefono_input.send_keys(telefono)
        print("Teléfono ingresado")




