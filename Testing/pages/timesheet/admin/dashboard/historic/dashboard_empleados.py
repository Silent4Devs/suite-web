import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
import pdb
from config import username, password

class DashboardEmpleadosTimesheet:
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

    def timesheet_dashboard_index(self, dashboard_route):
        try:
            self.driver.get(dashboard_route)
            print("Index de timesheet cargado.")
        except Exception as e:
            print("Error al cargar el index de timesheet:", e)

    def empleados_section(self,empleados):
        try:
            self._click_element(empleados)
            print("Sección de empleados cargada.")
        except Exception as e:
            print("Error al cargar la sección de empleados:", e)

    def empleado_area_select_graphic(self,select1,registro1):
        try:
            self._select_option_by_text(select1,registro1)
            print("Registro seleccionado correctamente")
            print("Se imprimio el registro: ",registro1)
        except Exception as e:
            print("Error al seleccionar el registro")

    def registro_timesheet_mes_select_graphic(self,select2,registro2):
        try:
            self.driver.execute_script("window.scrollTo(0, 600)")
            self._select_option_by_text(select2,registro2)
            print("Registro seleccionado correctamente")
            print("Se imprimio el registro: ",registro2)
        except Exception as e:
            print("Error al seleccionar el registro")


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

    def _select_option_by_text(self, locator, text):
        select = Select(self.driver.find_element(By.XPATH, locator))
        select.select_by_visible_text(text)

    def _click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()
