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



#Registrar Horas
try:
    time.sleep(tiempo_carga)
    btn = driver.find_element(By.XPATH, "//font[@class='letra_blanca'][contains(.,'Timesheet')]")
    btn.click()
    time.sleep(tiempo_modulos)
    btn = driver.find_element(By.XPATH, "//a[contains(.,'Registrar Horas')]")
    time.sleep(tiempo_modulos)
    btn.click()
    time.sleep(tiempo_carga)
    date_input=driver.find_element(By.XPATH,"//input[@type='text'][contains(@id,'dia')]")
    date_input.click()
    day_element = driver.find_element(By.XPATH, "//span[@class='flatpickr-day'][contains(.,'24')]")
    day_element.click()
    time.sleep(tiempo_carga)

        #PROYECTO

    select_container_xpath = "//span[@class='select2-selection__rendered'][contains(@id,'proyectos1-container')][contains(.,'Seleccione proyecto')]"
    select_container = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container_xpath)))
    select_container.click()

    print("Buscando proyecto")
    # Buscamos el proyecto
    search_proyecto = WebDriverWait(driver, 10).until(
        EC.element_to_be_clickable((By.XPATH, "//input[contains(@class,'select2-search__field')]"))
    )
    search_proyecto.send_keys("TABANTAJ")

    print("Esperando Resultados")
    # Esperamos a que aparezcan los resultados
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, "//li[@class='select2-results__option']")))

    print("Seleccionando proyecto")
    # Seleccionamos el proyecto específico
    option_xpath = "//li[contains(@id,'proyectos1-result')][contains(.,'I 015 - PRO-INT-S4B Tabantaj')]"
    option_element = driver.find_element(By.XPATH, option_xpath)
    option_element.click()

        #TAREA

    print("Seleccionando tarea")
    # Esperamos a que aparezca el campo de búsqueda de tareas
    search_homework_container = WebDriverWait(driver, 10).until(
        EC.element_to_be_clickable((By.XPATH, "//span[@class='select2-selection__rendered'][contains(@id,'tareas1-container')][contains(.,'Seleccione tarea')]"))
    )
    search_homework_container.click()

    print("Buscando tarea")
    # Esperamos a que aparezca el campo de búsqueda de tareas
    search_homework_input = WebDriverWait(driver, 10).until(
        EC.element_to_be_clickable((By.XPATH, "//input[contains(@class,'select2-search__field')]"))
    )
    search_homework_input.send_keys("Test")

    print("Esperando resultados de tarea")
    # Esperamos a que aparezcan los resultados de tareas
    WebDriverWait(driver, 15).until(EC.presence_of_element_located((By.XPATH, "//li[@class='select2-results__option']")))

    print("Seleccionando tarea específica")
    # Seleccionamos la tarea específica
    option_xpath = "//li[contains(.,'Testing UX')]"
    option_element = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, option_xpath)))
    option_element.click()

    #HORAS

    monday=driver.find_element(By.XPATH,"//input[contains(@name,'timesheet[1][lunes]')]").send_keys("24")
    time.sleep(tiempo_espera)

    tuesday=driver.find_element(By.XPATH,"//input[contains(@name,'timesheet[1][martes]')]").send_keys("24")
    time.sleep(tiempo_espera)

    wednesday=driver.find_element(By.XPATH,"//input[contains(@name,'timesheet[1][miercoles]')]").send_keys("24")
    time.sleep(tiempo_espera)

    thursday=driver.find_element(By.XPATH,"//input[contains(@name,'timesheet[1][jueves]')]").send_keys("24")
    time.sleep(tiempo_espera)

    friday=driver.find_element(By.XPATH,"//input[contains(@name,'timesheet[1][viernes]')]").send_keys("24")
    time.sleep(tiempo_espera)

    saturday=driver.find_element(By.XPATH,"//input[contains(@name,'timesheet[1][sabado]')]").send_keys("24")
    time.sleep(tiempo_espera)

    sunday=driver.find_element(By.XPATH,"//input[contains(@name,'timesheet[1][domingo]')]").send_keys("24")
    time.sleep(tiempo_espera)

    #DESCRIPCION
    description=driver.find_element(By.XPATH,"//textarea[contains(@name,'timesheet[1][descripcion]')]").send_keys("北京位於華北平原的西北边缘，背靠燕山，有永定河流经老城西南，毗邻天津市、河北省，是一座有三千余年建城历史、八百六十余年建都史的历史文化名城，历史上有金、元、明、清、中华民国（北洋政府时期）等五个朝代在此定都，以及数个政权建政于此，荟萃了自元明清以来的中华文化，拥有众多历史名胜古迹和人文景观。《不列颠百科全书》将北京形容为全球最伟大的城市之一，而且断言，“这座城市是中国历史上最重要的组成部分。在中国过去的八个世纪里，不论历史是否悠久，几乎北京所有主要建筑都拥有着不可磨灭的民族和历史意义”。北京古迹众多，著名的有故宫、天坛、颐和园、圆明园、北海公园等 🔔🍺🥰😡😶‍🌫️👻😽👩🏻‍💼💷💡💖💞🕉️🆒🆗。")
    time.sleep(tiempo_espera)

    #REGISTRAR
    save_btn=driver.find_element(By.XPATH,"//label[@for='estatus_pendiente'][contains(.,'Registrar')]")
    time.sleep(tiempo_espera)


except TimeoutException as e:
    print(f"No se pudo seleccionar la tarea. Detalles: {e}")

except TimeoutException as e:
    print(f"No se pudo seleccionar el proyecto. Detalles: {e}")


except NoSuchElementException:
    print("Elemento no encontrado. Verifica el selector o espera explícita.")

