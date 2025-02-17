<tr id="tid_(#=obj.id#)" taskId="(#=obj.id#)"
    class="taskEditRow (#=obj.isParent()?'isParent':''#) (#=obj.collapsed?'collapsed':''#)" level="(#=level#)">
    <th class="gdfCell (#=level>1?'edit':''#)" align="right" style="cursor:pointer;"><span
            class="taskRowIndex">(#=obj.getRow()+1#)</span> <span class="teamworkIcon"
            style="font-size:12px;">(#=level>1?'e':''#)</span></th>
    <td class="gdfCell noClip" align="center">
        <div class="taskStatus cvcColorSquare" status="(#=obj.status#)"></div>
    </td>
    <td class="gdfCell indentCell" style="padding-left:(#=obj.level*10+18#)px;">
        <div class="exp-controller" align="center"></div>
        <input type="text" name="name" value="(#=obj.name#)" placeholder="name">
    </td>
    <td class="gdfCell" align="center"><input type="checkbox" name="startIsMilestone"></td>
    <td class="gdfCell"><input type="text" name="start" value="" class="date"></td>
    <td class="gdfCell" align="center"><input type="checkbox" name="endIsMilestone"></td>
    <td class="gdfCell"><input type="text" name="end" value="" class="date"></td>
    <td class="gdfCell"><input type="text" name="duration" autocomplete="off" value="(#=obj.duration#)">
    </td>
    <td class="gdfCell"><input type="text" name="progress" class="validated" entrytype="PERCENTILE"
            autocomplete="off" value="(#=obj.progress?obj.progress:''#)"
            (#=obj.progressByWorklog?"readOnly":"readOnly"#)></td>
    <td class="gdfCell requireCanSeeDep"><input type="text" name="depends" autocomplete="off"
            value="(#=obj.depends#)" (#=obj.hasExternalDep?"readonly":""#)></td>
    <td class="gdfCell taskAssigs">(#=obj.getAssigsString()#)</td>
</tr>
