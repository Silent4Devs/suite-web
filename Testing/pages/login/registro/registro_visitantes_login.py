import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.action_chains import ActionChains


class RegistroVisitantesLogin:
    def __init__(self, driver):
        self.driver = driver

    def registro_visitantes_login(self, nombre,apellido,correo,telefono,disp_electronico,marca,serie,motivo):
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("------ REGISTRO DE VISITANTES - TABANTAJ -----")
        time.sleep(4)
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
        time.sleep(1)
        nombre_input.send_keys(nombre)
        print("Nombre ingresado")

        apellido_input = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.ID, "apellidos"))
        )
        apellido_input.clear()

        apellido_input.send_keys(apellido)
        print("Apellido ingresado")

        correo_input = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.XPATH, "//input[@id='correo']"))
        )
        correo_input.clear()
        correo_input.send_keys(correo)

        print("Correo electrónico ingresado")

        telefono_input = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.XPATH, "//input[@id='celular']"))
)
        telefono_input.clear()

        telefono_input.send_keys(telefono)
        print("Teléfono ingresado")

        dispositivo_input = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.ID, "dispositivo0"))
        )
        dispositivo_input.clear()
        dispositivo_input.send_keys(disp_electronico)
        print("Dispositivo electrónico ingresado")

        marca_input = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.ID, "marca0"))
        )
        marca_input.clear()
        marca_input.send_keys(marca)
        print("Marca ingresada")

        serie_input = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.ID, "serie0"))
        )
        serie_input.clear()
        serie_input.send_keys(serie)

        motivo_input = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.ID, "motivo"))
        )
        motivo_input.clear()
        motivo_input.send_keys(motivo)
        time.sleep(1)

        siguiente_btn = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.XPATH, "//button[@class='btn btn-primary' and contains(text(), 'Siguiente')]"))
        )
        self.click_element_with_js(siguiente_btn)
        print("Botón siguiente presionado")

    def click_element_with_js(self, element):
        self.driver.execute_script("arguments[0].click();", element)





