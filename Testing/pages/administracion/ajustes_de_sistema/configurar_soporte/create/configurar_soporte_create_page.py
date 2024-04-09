import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from config import password_c, username_c


#Temporizadores
tiempo_modulos = 2

class Create_configurar_soporte:
    
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 10)

    def login(self):
        
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("Iniciando sesión en el sistema...")
        time.sleep(4)
        self._fill_input_field("input[name='email']", username_c)
        self._fill_input_field("input[name='password']", password_c)
        self._click_element("//button[@type='submit'][contains(text(),'Enviar')]")
        print("¡Sesión iniciada con éxito!")
        self.wait.until(EC.presence_of_element_located((By.CSS_SELECTOR, "img[alt='Logo Tabantaj']")))
        print("Login correcto.")
        
        print("URL actual:", self.driver.current_url)
        
        time.sleep(tiempo_modulos)
        
    def _fill_input_field(self, locator, value):
        input_field = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, locator)))
        input_field.clear()
        input_field.send_keys(value)

    def _click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()

    def _wait_and_fill(self, xpath, value):
        try:
            element = self.wait.until(EC.visibility_of_element_located((By.XPATH, xpath)))
            element.clear()
            element.send_keys(value)
        except TimeoutException:
            raise TimeoutError(f"Elemento no encontrado en {xpath}")
        
    def _wait_and_select(self, selector, opcion):
        try:
            select_element = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, selector)))
            select_element.click()
            option_xpath = f"//select[@name='sede']/option[text()='{opcion}']"
            option = self.wait.until(EC.visibility_of_element_located((By.XPATH, option_xpath)))
            option.click()
        except TimeoutException:
            raise TimeoutError(f"Elemento no encontrado en {selector}")
 
    def _wait_and_click(self, xpath):
        try:
            element = self.wait.until(EC.visibility_of_element_located((By.XPATH, xpath)))
            element.click()
        except TimeoutException:
            raise TimeoutError(f"Elemento no encontrado en {xpath}")



    ##########################################Entrar a Modulo y Submodulo

    def in_submodulo(self, menu_hamburguesa,element_entrar_modulo,element_entrar_submodulo):
        
        #Menu Hamburguesa
        print("Ingresando a Menu Hamburguesa")
        menu_hamb = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, menu_hamburguesa))
        )
        menu_hamb.click()

        time.sleep(tiempo_modulos)
        
        #Modulo Administracion
        print("Ingresando a Moldulo Administracion")
        menu_sg = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, element_entrar_modulo))
        )
        menu_sg.click()
        
        time.sleep(tiempo_modulos)
        
        #Configurar Soporte
        print("Ingresando a Submenu Configurar Soporte")
        sub_clasif= WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, element_entrar_submodulo))
        )
        sub_clasif.click()
        
        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)

    ########################################## Agregar Clasificacion y llenar repositorio

    def add_configurar_soporte(self, agregar_btn_xpath, guardar_xpath):
    
        time.sleep(tiempo_modulos)
        
        # Dando clic en Boton Agregar Configurar soporte
        print("Dando clic al botón Agregar ...")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)
        
        # Rol
        
        campo_rol = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SELECT[@id='rol']"))
            )
        campo_rol.click()
        time.sleep(tiempo_modulos)
        campo_rol.send_keys("Soporte técnico")
        time.sleep(tiempo_modulos)
        campo_rol.click()
        print("Asignando Rol")
        
        time.sleep(tiempo_modulos)
        
        # Empleado
        
        campo_empleado = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SELECT[@id='id_elaboro']"))
            )
        campo_empleado.click()
        time.sleep(tiempo_modulos)
        campo_empleado.send_keys("Benito López Mejía")
        time.sleep(tiempo_modulos)
        campo_empleado.click()
        print("Asignando Empleado")
        
        time.sleep(tiempo_modulos)

        # Guardar Repositorio
        print("Dando clic al botón Guardar...")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()
        
        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)

