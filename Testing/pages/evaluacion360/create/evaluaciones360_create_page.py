import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
import pdb
from config import username, password

class Evaluaciones360Create:
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 20)

    def login(self):
        try:
            self.driver.get('https://192.168.9.78/')
            self.driver.maximize_window()
            print("Iniciando sesión en el sistema...")
            time.sleep(4)
            self._fill_input_field_css("input[name='email']", username)
            self._fill_input_field_css("input[name='password']", password)
            self._click_element("//button[@type='submit'][contains(text(),'Enviar')]")
            print("¡Sesión iniciada con éxito!")
            self.wait.until(EC.presence_of_element_located((By.CSS_SELECTOR, "img[alt='Logo Tabantaj']")))
            print("Login correcto.")
        except Exception as e:
            print("Error durante el inicio de sesión:", e)

    def cap_humano_index(self, index_cap_humano):
        try:
            self.driver.get(index_cap_humano)
            print("Index de evaluaciones 360 cargado.")
        except Exception as e:
            print("Error al cargar el index de evaluaciones 360:", e)

    def ev360_options(self):
        try:
            self._click_element("//a[contains(.,'Evaluación 360')]")
            print("Opciones de evaluaciones 360 cargadas.")
        except Exception as e:
            print("Error al cargar las opciones de evaluaciones 360:", e)

    def crear_ev360(self):
        try:
            self._click_element("//a[@href='https://192.168.9.78/admin/recursos-humanos/evaluacion-360/evaluaciones/create']")
            print("Formulario de creación de evaluación 360 cargado.")
        except Exception as e:
            print("Error al cargar el formulario de creación de evaluación 360:", e)

    def nombre_evaluacion(self, nombre):
        try:
            self._fill_input_field_xpath("//input[@id='nombre']", nombre)
            print("Nombre de la evaluación ingresado.")
        except Exception as e:
            print("Error al ingresar el nombre de la evaluación:", e)

    def _fill_input_field_xpath(self, locator, value):
        input_field = self.wait.until(EC.visibility_of_element_located((By.XPATH, locator)))
        input_field.clear()
        input_field.send_keys(value)

    def _fill_input_field_css(self, locator, value):
            input_field = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, locator)))
            input_field.clear()
            input_field.send_keys(value)

    def _click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()
