from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

class MisRegistrosPapelera:
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 20)

    def timesheet_borrador_route(self):
        try:
            self.driver.get('https://192.168.9.78/admin/timesheet/mis-registros/papelera#')
            self.driver.maximize_window()
            self.wait.until(EC.url_matches("https://.*"))
            print("Conexión HTTPS exitosa")
        except Exception as e:
            print("Error al consegiuir la ruta Timesheet Mis Registros Borrador:", e)

    def is_https(self):
        try:
            return self.driver.current_url.startswith("https://")
        except Exception as e:
            print("Error al verificar la conexión HTTPS:", e)
            return False
