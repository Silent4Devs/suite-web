import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from config import password_c, username_c


#Temporizadores
tiempo_modulos = 2

class Edit_Usuarios:
    
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

    def in_submodulo(self, menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo):
    
        time.sleep(tiempo_modulos)
        
        #Menu Hamburguesa
        print("Ingresando a Menu Hamburguesa")
        menu_hamb = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, menu_hamburguesa))
        )
        menu_hamb.click()

        time.sleep(5)
        
        #Modulo Ajuste de Usuario
        print("Ingresando a Modulo Ajuste de Usuario ...")
        in_modulo = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, element_entrar_modulo))
        )
        in_modulo.click()
        
        time.sleep(tiempo_modulos)
        
        #Submodulo Usuarios
        print("Ingresando a Submodulo Usuarios ...")
        sub_modulo= WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.XPATH, element_entrar_submodulo))
        )
        sub_modulo.click()
        
        time.sleep(5)
        
        print("URL actual:", self.driver.current_url)



    ########################################## Agregar 

    def edit_usuarios(self, campo_buscar_xpath, boton_editar, guardar_xpath):
        
        time.sleep(tiempo_modulos)
        
        # Campo Buscar
        campo_entrada = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, campo_buscar_xpath))
        )
        campo_entrada.clear()
        #campo_entrada.send_keys("Nombre de Usuario de Prueba 01117")

        time.sleep(tiempo_modulos)

        """
        # Boton 3 puntos
        print("Dando clic al botón 3 puntos...")
        wait = WebDriverWait(driver, 10)
        # Esperar a que el elemento esté presente en el DOM
        puntos_btn = wait.until(EC.presence_of_element_located((By.XPATH, trespuntos_btn_xpath)))
        # Ahora intenta hacer clic en el elemento
        puntos_btn.click()

        time.sleep(tiempo_modulos) """

        # Boton editar
        print("Dando clic al botón editar...")
        wait = WebDriverWait(self.driver, 10)
        # Esperar a que el elemento esté presente en el DOM
        btn_editar = wait.until(EC.presence_of_element_located((By.XPATH, boton_editar)))
        # Ahora intenta hacer clic en el elemento
        btn_editar.click()

        time.sleep(tiempo_modulos)  
        
        # Actualizar Correo Electronico
        
        campo_email = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='email']"))
            )
        campo_email.click()
        campo_email.send_keys("prueba@prueba.com")
        print("Actualizando correo electronico")
        
        time.sleep(tiempo_modulos)
        

        # Guardar actualización
        print("Dando clic al botón Guardar para guardar actualización...")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()
        
        print("URL actual:", self.driver.current_url)

        time.sleep(tiempo_modulos)  
                                