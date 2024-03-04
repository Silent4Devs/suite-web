import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC


class RegistroVisitantesLogin:
    def __init__(self, driver):
        self.driver = driver

    def registro_visitantes_login(self):
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("------ REGISTRO DE VISITANTES - TABANTAJ -----")
        time.sleep(7)
        registro_visitantes_btn= WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//a[contains(.,'Registro de Visitantes')]"))
        )
        registro_visitantes_btn.click()
        print("URL actual:", self.driver.current_url)
        registro_entrada_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//a[contains(@href, 'visitantes') and contains(@class, 'rounded')]"))
        )
        registro_entrada_btn.click()




