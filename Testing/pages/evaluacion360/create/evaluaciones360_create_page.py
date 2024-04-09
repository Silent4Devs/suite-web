import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
from selenium.common.exceptions import TimeoutException
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
        self.driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
    def descripcion_evaluacion(self, descripcion):
        try:
            self._fill_input_field_xpath("//textarea[@class='form-control ' and @name='descripcion']", descripcion)
            print("Descripción de la evaluación ingresada.")
        except Exception as e:
            print("Error al ingresar la descripción de la evaluación:", e)
    def check_evaluacion(self):
        try:
            self._click_element("//span[@class='checkmark']")
            print("Check de la evaluación seleccionado.")
        except Exception as e:
            print("Error al seleccionar el check de la evaluación:", e)

    def siguiente(self):
        try:
            self._click_element("//button[contains(text(), 'Siguiente')]")
            print("Siguiente paso.")
        except Exception as e:
            print("Error al pasar al siguiente paso:", e)

    def publico_objetivo_select(self):
        try:
            self._select_option_by_text("//select[@id='evaluados_objetivo']", "Toda la empresa")
            print("Público objetivo seleccionado.")
            time.sleep(2)
        except Exception as e:
            print("Error al seleccionar el público objetivo:", e)

    def publico_objetivo_select_area(self):
        try:
            self._select_option_by_text("//select[@id='evaluados_objetivo']", "Área")
            print("Público objetivo seleccionado.")
            time.sleep(2)
        except Exception as e:
            print("Error al seleccionar el público objetivo:", e)

    def siguiente_2(self):
        try:
            self._click_element("//button[contains(text(), 'Siguiente')]")
            print("Siguiente paso.")

        except Exception as e:
            print("Error al pasar al siguiente paso:", e)

    def siguiente_3(self,xpath):
        try:
            self ._click_element(xpath)
            print("Siguiente paso.")
        except Exception as e:
            print("Error al pasar al siguiente paso:", e)


    def wait_until_element_available(self, xpath, timeout=10):
        try:
            element = WebDriverWait(self.driver, timeout).until(
                EC.presence_of_element_located((By.XPATH, xpath))
            )
            element.click()
            return element
        except TimeoutException:
            print(f"Elemento con XPath '{xpath}' no encontrado después de {timeout} segundos.")
            return None

    def _select_option_by_text(self, locator, text):
        select = Select(self.driver.find_element(By.XPATH, locator))
        select.select_by_visible_text(text)

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
