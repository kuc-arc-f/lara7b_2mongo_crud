class IndexRow extends React.Component {
    componentDidMount(){
//        console.log(this.props.obj)
    }
    render(){
console.log( this.props.obj._id.$oid )
        return (
        <tr>
            <td>
                {this.props.obj._id.$oid}
            </td>
            <td>
                <a href={"/tasks/"+ this.props.obj._id.$oid}>{this.props.obj.title}
                </a>
                <a href={"/tasks/"+ this.props.obj._id.$oid +"/edit"} > [ edit ]
                </a>
            </td>
            <td>
            </td>
        </tr>
        )
    }
}

