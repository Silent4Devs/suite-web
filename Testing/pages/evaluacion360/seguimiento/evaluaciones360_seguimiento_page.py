import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
import pdb
from config import username, password

class Evaluaciones360Seguimiento:
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 20)

    def login(self,logo,btn_enviar,username_input,password_input):
        try:
            self.driver.get('https://192.168.9.78/')
            self.driver.maximize_window()
            print("Iniciando sesión en el sistema...")
            time.sleep(4)
            self._fill_input_field_css(username_input, username)
            self._fill_input_field_css(password_input, password)
            self._click_element(btn_enviar)
            print("¡Sesión iniciada con éxito!")
            self.wait.until(EC.presence_of_element_located((By.CSS_SELECTOR, logo)))
        except Exception as e:
            print("Error durante el inicio de sesión:", e)

    def cap_humano_index(self, index_cap_humano):
        try:
            self.driver.get(index_cap_humano)
            print("Seguimiento de Evaluaciones 360 cargado.")
        except Exception as e:
            print("Error al cargar Seguimiento de Evaluaciones 360:", e)

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
