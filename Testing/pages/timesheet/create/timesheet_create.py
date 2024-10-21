import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException, TimeoutException
from selenium.webdriver.support.ui import Select
from config import username, password

class TimesheetCreate:
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 20)

    def login(self,app_url, logo, btn_enviar, username_input, password_input):
        try:
            self.driver.get(app_url)
            self.driver.maximize_window()
            print("Iniciando sesión en el sistema...")
            time.sleep(4)
            self.fill_input_field_css(username_input, username)
            self.fill_input_field_css(password_input, password)
            self.click_element(btn_enviar)
            print("¡Sesión iniciada con éxito!")
            self.wait.until(EC.presence_of_element_located((By.CSS_SELECTOR, logo)))
        except Exception as e:
            print("Error durante el inicio de sesión:", e)

    def index(self, timesheet_create):
        try:
            self.driver.get(timesheet_create)
            print("Vista Timesheet Create al 100%.")
            print("URL actual: ", self.driver.current_url)
        except Exception as e:
            print("Error al cargar el index de Timesheet:", e)

    def fill_input_field_css(self, locator, value):
            input_field = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, locator)))
            input_field.clear()
            input_field.send_keys(value)

    def _select_option_by_text(self, locator, text):
        select = Select(self.driver.find_element(By.XPATH, locator))
        select.select_by_visible_text(text)

    def fill_input_field_xpath(self, locator, value):
        input_field = self.wait.until(EC.visibility_of_element_located((By.XPATH, locator)))
        input_field.clear()
        input_field.send_keys(value)

    def click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()
