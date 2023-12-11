from selenium import webdriver
import os
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import TimeoutException
import time
tiempo_modulos=4
tiempo_carga=10
tiempo_espera=2.5
tiempo_sec=1
element_xpath0 = "(//font[@class='letra_blanca'][contains(.,'Capital Humano')])[1]"
element_xpath1= "//a[contains(.,'Solicitudes e Incidencias')]"
element_xpath2="//button[@class='btn btn-danger'][contains(.,'Guardar')]"
#driver Firefox
driver=webdriver.Firefox()

#Open URL
driver.get('https://192.168.9.78/')

#Maximize Window
driver.maximize_window()
time.sleep(5)

#Login
usr=driver.find_element(By.XPATH,"//input[contains(@name,'email')]").send_keys("zaid.garcia@becarios.silent4business.com")
time.sleep(tiempo_modulos)
pw=driver.find_element(By.XPATH,"//input[contains(@name,'password')]").send_keys("ranas289")
time.sleep(tiempo_modulos)
btn=driver.find_element(By.XPATH,"//button[@type='submit'][contains(.,'Enviar')]")
btn.click()

#Capital Humano
element = driver.find_element(By.XPATH, element_xpath0)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_xpath0)))
time.sleep(tiempo_modulos)
element.click()
time.sleep(tiempo_espera)

#Solictudes e Incidencias
element1 = driver.find_element(By.XPATH, element_xpath1)
driver.execute_script("arguments[0].scrollIntoView(true);", element1)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_xpath1)))
time.sleep(tiempo_modulos)
element1.click()
time.sleep(tiempo_espera)

#Ajustes de Vacaciones
ajustes_vacaciones=driver.find_element(By.XPATH,"//a[contains(.,'Ajustes Vacaciones')]")
time.sleep(tiempo_modulos)
ajustes_vacaciones.click()
time.sleep(tiempo_espera)

#Lineamientos
lineamientos=driver.find_element(By.XPATH,"//a[contains(.,'Lineamientos')]")
time.sleep(tiempo_modulos)
lineamientos.click()
time.sleep(tiempo_espera)
#Crear linemaientos
crear_lineamientos=driver.find_element(By.XPATH,"//a[contains(.,'Crear Lineamiento +')]")
time.sleep(tiempo_modulos)
crear_lineamientos.click()
time.sleep(tiempo_espera)
#Nombre del lineamiento de vacaciones
nombre_lineamiento=driver.find_element(By.XPATH,"//input[contains(@minlength,'1')]").send_keys("北京位於華北平原的西北边缘，背靠燕山，有永定河流经老城西南，毗邻天津市、河北省。")
time.sleep(tiempo_espera)

#Tipo de conteo
tipo_de_conteo = driver.find_element(By.XPATH, "//select[@id='tipo_conteo']")
time.sleep(tiempo_modulos)
tipo_de_conteo.click()
        #Seleccionar tipo de conteo
select_element = Select(tipo_de_conteo)
time.sleep(tiempo_modulos)
select_element.select_by_visible_text('Día Natural')
time.sleep(tiempo_espera)

        #Descripción
descripcion=driver.find_element(By.XPATH,"//textarea[contains(@class,'form-control')]").send_keys("Leone Sextus Denys Oswolf Fraudatifilius Tollemache-Tollemache de Orellana Plantagenet Tollemache-Tollemache")

        #Año de inicio de beneficio
#año_de_inicio_de_beneficio = driver.find_element(By.XPATH, "//input[contains(@name,'inicio_conteo')]").send_keys("-1")
#año_de_inicio_de_beneficio = driver.find_element(By.XPATH, "//input[contains(@name,'inicio_conteo')]").send_keys("0")
#año_de_inicio_de_beneficio = driver.find_element(By.XPATH, "//input[contains(@name,'inicio_conteo')]").send_keys("200000000000000")
año_de_inicio_de_beneficio = driver.find_element(By.XPATH, "//input[contains(@name,'inicio_conteo')]").send_keys("20")
time.sleep(tiempo_espera)
        #Año fin de beneficio
año_de_fin_de_beneficio = driver.find_element(By.XPATH, "//input[contains(@name,'fin_conteo')]").send_keys("21")
time.sleep(tiempo_espera)
        #Días a gozar
dia_gozar=driver.find_element(By.XPATH,"//input[contains(@max,'24')]").send_keys("24")
time.sleep(tiempo_espera)
        #Reinicio de conteo
reinicio_conteo = driver.find_element(By.XPATH, "//select[contains(@id,'corte')]")
time.sleep(tiempo_modulos)
reinicio_conteo.click()
        #Seleccionar tipo de conteo
select_element1 = Select(reinicio_conteo)
time.sleep(tiempo_modulos)
select_element1.select_by_visible_text('Anual')
time.sleep(tiempo_espera)

#Colaboradores a los que aplica
#
radio_value_to_select = "1"
radio_button_xpath = f"//input[@type='radio' and @value='{1}']"

radio_button = driver.find_element(By.XPATH, radio_button_xpath)
radio_button.click()

#Guardar
time.sleep(tiempo_espera)
save_btn=driver.find_element(By.XPATH,"//button[@class='btn btn-danger'][contains(.,'Guardar')]")
time.sleep(tiempo_sec)
save_btn.click()

    #confirmación
time.sleep(tiempo_espera)
ok_btn=driver.find_element(By.XPATH,"//button[@type='button'][contains(.,'OK')]")
ok_btn.click()

#Opciones
opciones=driver.find_element(By.XPATH,"(//i[contains(@class,'fa-solid fa-ellipsis-vertical')])[1]")
time.sleep(tiempo_sec)
opciones.click()
    #Ver
ver_eye=driver.find_element(By.XPATH,"(//i[contains(@class,'fas fa-eye')])[1]")
time.sleep(tiempo_sec)
ver_eye.click()
        #Regresar
time.sleep(tiempo_modulos)
back=driver.find_element(By.XPATH,"(//a[@class='btn btn-default'][contains(.,'Regresar')])[2]")
time.sleep(tiempo_sec)
back.click()

# Define a function for the "Opciones" part
time.sleep(tiempo_espera)
def click_opciones():
    opciones = WebDriverWait(driver, 10).until(
        EC.element_to_be_clickable((By.XPATH, "(//i[contains(@class,'fa-solid fa-ellipsis-vertical')])[1]"))
    )
    opciones.click()
# Initial click on "Opciones"
time.sleep(tiempo_espera)
click_opciones()

# Ver
ver_eye = WebDriverWait(driver, 10).until(
    EC.element_to_be_clickable((By.XPATH, "(//i[contains(@class,'fas fa-eye')])[1]"))
)
time.sleep(tiempo_espera)
ver_eye.click()

# Regresar
back = WebDriverWait(driver, 10).until(
    EC.element_to_be_clickable((By.XPATH, "(//a[@class='btn btn-default'][contains(.,'Regresar')])[2]"))
)
time.sleep(tiempo_espera)
back.click()

# Editar
time.sleep(tiempo_espera)
click_opciones()
edit= WebDriverWait(driver, 10).until(
    EC.element_to_be_clickable((By.XPATH, "(//i[contains(@class,'fas fa-edit')])[1]"))
)
time.sleep(tiempo_espera)
edit.click()
element3 = driver.find_element(By.XPATH, element_xpath2)
driver.execute_script("arguments[0].scrollIntoView(true);", element3)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_xpath2)))
time.sleep(tiempo_modulos)
element3.click()


#Eliminar
time.sleep(tiempo_espera)
click_opciones()
delete= WebDriverWait(driver, 10).until(
    EC.element_to_be_clickable((By.XPATH, "//div[contains(@class,'btn btn-sm text-danger 28 rounded')]"))
)
time.sleep(tiempo_espera)
delete.click()

delete_sure= driver.find_element(By.XPATH, "//button[@class='btn btn-danger']")
time.sleep(tiempo_espera)
delete_sure.click()
time.sleep(tiempo_espera)

#Cerrar navegador
driver.quit()

