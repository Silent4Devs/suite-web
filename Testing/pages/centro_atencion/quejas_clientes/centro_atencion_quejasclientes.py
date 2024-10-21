import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support.ui import Select
import pdb
from config import username, password


class QuejasClientesView:
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 20)

    def login(self):
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("Iniciando sesión en el sistema...")
        time.sleep(4)
        self._fill_input_field("input[name='email']", username)
        self._fill_input_field("input[name='password']", password)
        self._click_element("//button[@type='submit'][contains(text(),'Enviar')]")
        print("¡Sesión iniciada con éxito!")
        self.wait.until(EC.presence_of_element_located((By.CSS_SELECTOR, "img[alt='Logo Tabantaj']")))
        print("Login correcto.")

    def open_menu(self):
        print("Abriendo menú...")
        self._click_element("//button[@class='btn-menu-header']")
        print("Menú abierto.")

    def navigate_to_centro_atencion(self):
        print("Navegando al Centro de Atención...")
        self._click_element("//a[@href='https://192.168.9.78/admin/desk' and normalize-space()='Centro de atención']")
        print("Página del Centro de Atención cargada.")

    def _fill_input_field(self, locator, value):
        input_field = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, locator)))
        input_field.clear()
        input_field.send_keys(value)

    def _click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()
