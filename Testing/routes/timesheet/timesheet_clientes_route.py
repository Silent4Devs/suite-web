from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

class Clientes:
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 20)

    def timesheet_clientes_route(self):
        try:
            self.driver.get('https://192.168.9.78/admin/timesheet/clientes')
            self.driver.maximize_window()
            self.wait.until(EC.url_matches("https://.*"))
            print("Conexión HTTPS exitosa")
        except Exception as e:
            raise AssertionError("Error al conseguir la ruta Timesheet Clientes:", e)

    def is_https(self):
        try:
            return self.driver.current_url.startswith("https://")
        except Exception as e:
            raise AssertionError("Error al verificar la conexión HTTPS:", e)