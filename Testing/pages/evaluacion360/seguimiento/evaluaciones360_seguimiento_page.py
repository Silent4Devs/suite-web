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

    def mostrar_select(self,select):
        try:
            self._select_option_by_text(select, "100")
            print("Evaluación 360 seleccionada.")

        except Exception as e:
            print("Error al seleccionar la Evaluación 360:", e)
    def csv_download(self,csv):
        try:
            self._click_element(csv)
            print("Descarga de CSV iniciada.")

        except Exception as e:
            print("Error al descargar CSV:", e)
    def excel_download(self,excel):
        try:
            self._click_element(excel)
            print("Descarga de Excel iniciada.")

        except Exception as e:
            print("Error al descargar Excel:", e)

    def pdf_download(self, pdf):
        try:
            self._click_element(pdf)
            print("Descarga de PDF iniciada.")
        except Exception as e:
            print("Error al descargar PDF:", e)

    def imprimir(self,imprimir):
        try:
            self._click_element(imprimir)
            print("Impresión iniciada.")
        except Exception as e:
            print("Error al imprimir:", e)

    def searchbar(self,search_bar,credential):
        try:
            self._fill_input_field_xpath(search_bar,credential)
            print("Búsqueda realizada.")
        except Exception as e:
            print("Error al realizar la búsqueda:", e)

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
